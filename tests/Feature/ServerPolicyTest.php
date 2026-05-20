<?php

use App\Models\Server;
use App\Models\User;

test('user can only view their own servers', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $myServer = Server::factory()->create(['user_id' => $user->id]);
    $otherServer = Server::factory()->create(['user_id' => $otherUser->id]);

    expect($user->can('view', $myServer))->toBeTrue();
    expect($user->can('view', $otherServer))->toBeFalse();
});

test('user can only update their own servers', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $myServer = Server::factory()->create(['user_id' => $user->id]);
    $otherServer = Server::factory()->create(['user_id' => $otherUser->id]);

    expect($user->can('update', $myServer))->toBeTrue();
    expect($user->can('update', $otherServer))->toBeFalse();
});

test('user can only delete their own servers', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $myServer = Server::factory()->create(['user_id' => $user->id]);
    $otherServer = Server::factory()->create(['user_id' => $otherUser->id]);

    expect($user->can('delete', $myServer))->toBeTrue();
    expect($user->can('delete', $otherServer))->toBeFalse();
});
