<?php

use App\Enums\UserRole;
use App\Models\QuickCommand;
use App\Models\Server;
use App\Models\SshKey;
use App\Models\Tag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create(['role' => UserRole::Admin]);
    Sanctum::actingAs($this->user);
});

test('can list servers', function () {
    Server::factory()->count(3)->create(['user_id' => $this->user->id]);

    $this->getJson('/api/v1/servers')
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

test('can create a server', function () {
    $data = [
        'name' => 'New Server',
        'host' => '1.2.3.4',
        'port' => 22,
        'username' => 'root',
        'auth_type' => 'password',
        'password' => 'secret',
    ];

    $this->postJson('/api/v1/servers', $data)
        ->assertStatus(201)
        ->assertJsonPath('data.name', 'New Server');

    $this->assertDatabaseHas('servers', ['name' => 'New Server']);
});

test('can update a server', function () {
    $server = Server::factory()->create(['user_id' => $this->user->id]);

    $this->putJson("/api/v1/servers/{$server->id}", ['name' => 'Updated Name'])
        ->assertStatus(200)
        ->assertJsonPath('data.name', 'Updated Name');

    $this->assertDatabaseHas('servers', ['id' => $server->id, 'name' => 'Updated Name']);
});

test('can delete a server', function () {
    $server = Server::factory()->create(['user_id' => $this->user->id]);

    $this->deleteJson("/api/v1/servers/{$server->id}")
        ->assertStatus(204);

    $this->assertDatabaseMissing('servers', ['id' => $server->id]);
});

test('can list ssh keys', function () {
    SshKey::factory()->count(2)->create(['user_id' => $this->user->id]);

    $this->getJson('/api/v1/ssh-keys')
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('can list tags', function () {
    Tag::factory()->count(2)->create(['user_id' => $this->user->id]);

    $this->getJson('/api/v1/tags')
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('can list quick commands', function () {
    QuickCommand::factory()->count(2)->create(['user_id' => $this->user->id]);

    $this->getJson('/api/v1/quick-commands')
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('server resource returns sensitive fields for E2EE sync', function () {
    $server = Server::factory()->create([
        'user_id' => $this->user->id,
        'password' => 'vault-encrypted-password-blob',
        'private_key' => 'vault-encrypted-key-blob',
        'passphrase' => 'vault-encrypted-passphrase-blob',
    ]);

    $response = $this->getJson("/api/v1/servers/{$server->id}")
        ->assertStatus(200);

    $response->assertJsonPath('data.password', 'vault-encrypted-password-blob');
    $response->assertJsonPath('data.private_key', 'vault-encrypted-key-blob');
    $response->assertJsonPath('data.passphrase', 'vault-encrypted-passphrase-blob');
});

test('ssh key resource returns sensitive fields for E2EE sync', function () {
    $sshKey = SshKey::factory()->create([
        'user_id' => $this->user->id,
        'private_key' => 'vault-encrypted-ssh-key-blob',
        'passphrase' => 'vault-encrypted-ssh-passphrase-blob',
    ]);

    $response = $this->getJson("/api/v1/ssh-keys/{$sshKey->id}")
        ->assertStatus(200);

    $response->assertJsonPath('data.private_key', 'vault-encrypted-ssh-key-blob');
    $response->assertJsonPath('data.passphrase', 'vault-encrypted-ssh-passphrase-blob');
});
