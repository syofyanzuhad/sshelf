<?php

use App\Enums\UserRole;
use App\Livewire\Servers\ServerList;
use App\Models\Server;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

test('admins can create servers', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    actingAs($admin)
        ->get(route('dashboard'))
        ->assertSee('Add Server');

    $this->assertTrue($admin->can('create', Server::class));
});

test('viewers cannot create servers', function () {
    $viewer = User::factory()->create(['role' => UserRole::Viewer]);

    actingAs($viewer)
        ->get(route('dashboard'))
        ->assertDontSee('Add Server');

    $this->assertFalse($viewer->can('create', Server::class));
});

test('admins can see all servers', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $otherUser = User::factory()->create();
    $server = Server::factory()->create(['user_id' => $otherUser->id, 'name' => 'Other Server']);

    actingAs($admin);

    $this->assertTrue($admin->can('view', $server));

    // Check if it appears in the list
    Livewire::test(ServerList::class)
        ->assertSee('Other Server');
});

test('viewers can see all servers but cannot edit them', function () {
    $viewer = User::factory()->create(['role' => UserRole::Viewer]);
    $otherUser = User::factory()->create(['role' => UserRole::Admin]);
    $server = Server::factory()->create(['user_id' => $otherUser->id, 'name' => 'Admin Server']);

    actingAs($viewer);

    $this->assertTrue($viewer->can('view', $server));
    $this->assertFalse($viewer->can('update', $server));
    $this->assertFalse($viewer->can('delete', $server));

    Livewire::test(ServerList::class)
        ->assertSee('Admin Server')
        ->assertDontSee('Edit')
        ->assertDontSee('Delete')
        ->assertSee('Terminal');
});

test('only admins can access user management', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $viewer = User::factory()->create(['role' => UserRole::Viewer]);

    actingAs($admin)
        ->get(route('users'))
        ->assertStatus(200)
        ->assertSee('User Management');

    actingAs($viewer)
        ->get(route('users'))
        ->assertStatus(403);
});
