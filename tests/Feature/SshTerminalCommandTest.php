<?php

namespace Tests\Feature;

use App\Events\TerminalOutput;
use App\Models\Server;
use App\Models\User;
use App\Services\SshShellService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Mockery;
use phpseclib3\Net\SSH2;
use Tests\TestCase;

class SshTerminalCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_terminal_command_reads_and_broadcasts_output()
    {
        Event::fake();
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        $sshMock = Mockery::mock(SSH2::class);
        $sshMock->shouldReceive('read')->once()->andReturn('welcome message');
        $sshMock->shouldReceive('read')->andReturn(''); // Subsequent reads empty
        $sshMock->shouldReceive('setTimeout')->once();

        $shellServiceMock = Mockery::mock(SshShellService::class)->makePartial();
        $shellServiceMock->shouldReceive('openShell')->once()->andReturn(true);
        $shellServiceMock->shouldReceive('getSsh')->andReturn($sshMock);
        
        $this->app->instance(SshShellService::class, $shellServiceMock);

        // Set status to closed so the while loop terminates after one iteration
        Cache::put("server.{$server->id}.status", 'closed');

        $this->artisan("app:ssh-terminal {$server->id}")
            ->assertExitCode(0);

        Event::assertDispatched(TerminalOutput::class, function ($event) use ($server) {
            return $event->serverId == $server->id && $event->output === 'welcome message';
        });
    }

    public function test_terminal_command_writes_input_from_cache()
    {
        Event::fake();
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        $sshMock = Mockery::mock(SSH2::class);
        $sshMock->shouldReceive('read')->andReturn('');
        $sshMock->shouldReceive('setTimeout');
        $sshMock->shouldReceive('write')->once()->with('ls -la');

        $shellServiceMock = Mockery::mock(SshShellService::class)->makePartial();
        $shellServiceMock->shouldReceive('openShell')->once()->andReturn(true);
        $shellServiceMock->shouldReceive('getSsh')->andReturn($sshMock);
        
        $this->app->instance(SshShellService::class, $shellServiceMock);

        // Put input in cache
        Cache::put("server.{$server->id}.input", 'ls -la');
        // Set status to closed so the while loop terminates
        Cache::put("server.{$server->id}.status", 'closed');

        $this->artisan("app:ssh-terminal {$server->id}")
            ->assertExitCode(0);
    }
}
