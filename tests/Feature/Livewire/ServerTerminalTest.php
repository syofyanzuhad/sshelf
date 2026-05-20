<?php

namespace Tests\Feature\Livewire;

use App\Models\Server;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use Livewire\Livewire;
use Tests\TestCase;

class ServerTerminalTest extends TestCase
{
    use RefreshDatabase;

    public function test_terminal_component_starts_background_process()
    {
        Process::fake();
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(\App\Livewire\Servers\ServerTerminal::class, ['server' => $server])
            ->assertStatus(200);

        Process::assertRan(function ($process) use ($server) {
            return str_contains($process->command, "php artisan app:ssh-terminal {$server->id}");
        });
        
        $this->assertEquals('open', Cache::get("server.{$server->id}.status"));
    }

    public function test_terminal_can_send_input_to_cache()
    {
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(\App\Livewire\Servers\ServerTerminal::class, ['server' => $server])
            ->call('sendInput', 'ls -la\n');

        $this->assertEquals('ls -la\n', Cache::get("server.{$server->id}.input"));
    }

    public function test_terminal_can_disconnect()
    {
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(\App\Livewire\Servers\ServerTerminal::class, ['server' => $server])
            ->call('disconnect')
            ->assertRedirect(route('dashboard'));

        $this->assertEquals('closed', Cache::get("server.{$server->id}.status"));
    }
}
