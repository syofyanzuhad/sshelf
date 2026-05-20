<?php

use App\Livewire\Servers\ServerForm;
use App\Livewire\Servers\ServerList;
use App\Models\Server;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('server list component renders', function () {
    Livewire::test(ServerList::class)
        ->assertStatus(200);
});

test('user can create a server', function () {
    Livewire::test(ServerForm::class)
        ->set('name', 'My Server')
        ->set('host', '1.2.3.4')
        ->set('port', 22)
        ->set('username', 'root')
        ->set('auth_type', 'password')
        ->set('password', 'secret')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('server-saved');

    $this->assertDatabaseHas('servers', [
        'user_id' => $this->user->id,
        'name' => 'My Server',
        'host' => '1.2.3.4',
    ]);
});

test('user can edit a server', function () {
    $server = Server::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(ServerForm::class)
        ->call('edit', $server)
        ->set('name', 'Updated Name')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('server-saved');

    expect($server->fresh()->name)->toBe('Updated Name');
});

test('user can delete a server', function () {
    $server = Server::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(ServerList::class)
        ->call('delete', $server);

    $this->assertDatabaseMissing('servers', ['id' => $server->id]);
});

test('user can duplicate a server', function () {
    $server = Server::factory()->create(['user_id' => $this->user->id, 'name' => 'Original']);

    Livewire::test(ServerList::class)
        ->call('duplicate', $server)
        ->assertDispatched('server-saved');

    $this->assertDatabaseHas('servers', [
        'user_id' => $this->user->id,
        'name' => 'Original (Copy)',
    ]);
});

test('user cannot edit another users server', function () {
    $otherUser = User::factory()->create();
    $server = Server::factory()->create(['user_id' => $otherUser->id]);

    Livewire::test(ServerForm::class)
        ->call('edit', $server)
        ->assertForbidden();
});

test('server form validation', function () {
    Livewire::test(ServerForm::class)
        ->call('save')
        ->assertHasErrors([
            'name' => 'required',
            'host' => 'required',
            'username' => 'required',
        ]);
});
