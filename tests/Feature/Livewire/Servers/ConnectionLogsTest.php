<?php

namespace Tests\Feature\Livewire\Servers;

use App\Livewire\Servers\ConnectionLogs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ConnectionLogsTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $user = \App\Models\User::factory()->create();

        Livewire::actingAs($user)
            ->test(ConnectionLogs::class)
            ->assertStatus(200);
    }
}
