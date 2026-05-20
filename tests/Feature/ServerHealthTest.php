<?php

use App\Events\ServerHealthUpdated;
use App\Jobs\CheckServerHealth;
use App\Models\Server;
use App\Models\User;
use App\Services\SshService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;

it('checks server health and dispatches event when successful', function () {
    Event::fake();

    $user = User::factory()->create();
    $server = Server::factory()->create([
        'user_id' => $user->id,
        'status' => 'unknown',
    ]);

    $this->mock(SshService::class, function (MockInterface $mock) {
        $mock->shouldReceive('executeCommand')
            ->once()
            ->andReturn([
                'success' => true,
                'output' => "CPU:15.5\nMEM:42.1\nDSK:65",
            ]);
    });

    $job = new CheckServerHealth($server);
    $job->handle(app(SshService::class));

    $server->refresh();
    expect($server->status)->toBe('online');
    expect($server->cpu_usage)->toBe(15.5);
    expect($server->memory_usage)->toBe(42.1);
    expect($server->disk_usage)->toBe(65.0);
    expect($server->last_checked_at)->not->toBeNull();

    Event::assertDispatched(ServerHealthUpdated::class, function ($event) use ($server) {
        return $event->serverId === $server->id
            && $event->stats['status'] === 'online'
            && $event->stats['cpu'] === 15.5
            && $event->stats['memory'] === 42.1
            && $event->stats['disk'] === 65.0;
    });
});

it('marks server offline when ssh command fails', function () {
    Event::fake();

    $user = User::factory()->create();
    $server = Server::factory()->create([
        'user_id' => $user->id,
        'status' => 'online',
    ]);

    $this->mock(SshService::class, function (MockInterface $mock) {
        $mock->shouldReceive('executeCommand')
            ->once()
            ->andReturn([
                'success' => false,
                'output' => 'Connection timed out',
            ]);
    });

    $job = new CheckServerHealth($server);
    $job->handle(app(SshService::class));

    $server->refresh();
    expect($server->status)->toBe('offline');

    Event::assertDispatched(ServerHealthUpdated::class, function ($event) use ($server) {
        return $event->serverId === $server->id
            && $event->stats['status'] === 'offline'
            && $event->stats['cpu'] === null;
    });
});

it('dispatches health check jobs for all servers', function () {
    Queue::fake();

    Server::factory(3)->create();

    $this->artisan('servers:monitor')->assertSuccessful();

    Queue::assertPushed(CheckServerHealth::class, 3);
});
