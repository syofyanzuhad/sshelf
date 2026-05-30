<?php

use App\Models\User;

test('it returns the desktop login bridge view with configuration', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('desktop.login'));

    $response->assertOk();
    $response->assertViewIs('auth.desktop-bridge');
    
    $response->assertViewHas('deeplink');
    $response->assertViewHas('config');

    $deeplink = $response->viewData('deeplink');
    $config = $response->viewData('config');

    expect($deeplink)->toStartWith('sshelf://auth?');
    expect($config)->toHaveKeys(['token', 'url', 'reverb_key', 'reverb_port']);
    expect($config['url'])->toBe(config('app.url').'/api/v1');

    // Verify token was created
    expect($user->tokens)->toHaveCount(1);
    expect($user->tokens->first()->name)->toBe('Sshelf Desktop');
});

test('it requires authentication', function () {
    $response = $this->get(route('desktop.login'));

    $response->assertRedirect(route('login'));
});
