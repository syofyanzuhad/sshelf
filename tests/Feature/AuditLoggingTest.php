<?php

namespace Tests\Feature;

use App\Models\Server;
use App\Models\User;
use App\Models\ConnectionLog;
use App\Livewire\Servers\ServerTerminal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuditLoggingTest extends TestCase
{
    use RefreshDatabase;

    public function test_terminal_mount_creates_connection_log()
    {
        $user = User::factory()->create();
        $server = Server::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test(ServerTerminal::class, ['server' => $server])
            ->assertStatus(200);

        $this->assertDatabaseHas('connection_logs', [
            'server_id' => $server->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        
        $log = ConnectionLog::first();
        $this->assertNotNull($log->ip_address);
        $this->assertNotNull($log->user_agent);
    }
}
