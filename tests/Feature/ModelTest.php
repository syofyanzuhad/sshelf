<?php

use App\Models\Server;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('server credentials are encrypted in the database', function () {
    $user = User::factory()->create();
    $server = Server::create([
        'user_id' => $user->id,
        'name' => 'Secure Server',
        'host' => '1.2.3.4',
        'port' => 22,
        'username' => 'root',
        'auth_type' => 'password',
        'password' => 'secret-password',
    ]);

    // Check database directly to verify encryption
    $rawServer = DB::table('servers')->where('id', $server->id)->first();

    expect($rawServer->password)->not->toBe('secret-password');
    // Laravel encryption usually starts with a base64 encoded string or similar
    expect(decrypt($rawServer->password))->toBe('secret-password');

    // Check model access (should be decrypted)
    expect($server->password)->toBe('secret-password');
});

test('server belongs to a user', function () {
    $user = User::factory()->create();
    $server = Server::factory()->create(['user_id' => $user->id]);

    expect($server->user)->toBeInstanceOf(User::class);
    expect($server->user->id)->toBe($user->id);
});

test('server can have tags', function () {
    $user = User::factory()->create();
    $server = Server::factory()->create(['user_id' => $user->id]);
    $tag = Tag::create([
        'user_id' => $user->id,
        'name' => 'production',
    ]);

    $server->tags()->attach($tag);

    expect($server->tags)->toHaveCount(1);
    expect($server->tags->first()->name)->toBe('production');
});

test('user has many servers', function () {
    $user = User::factory()->create();
    Server::factory()->count(3)->create(['user_id' => $user->id]);

    expect($user->servers)->toHaveCount(3);
});
