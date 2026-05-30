<?php

use App\Models\User;

test('it redirects to the desktop app scheme with a token', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('desktop.login'));

    $response->assertRedirect();
    $targetUrl = $response->headers->get('Location');

    expect($targetUrl)->toStartWith('sshelf://auth?');

    $queryString = parse_url($targetUrl, PHP_URL_QUERY);
    parse_str($queryString, $params);

    expect($params)->toHaveKeys(['token', 'url', 'reverb_key', 'reverb_port']);
    expect($params['url'])->toBe(config('app.url').'/api/v1');

    // Verify token was created
    expect($user->tokens)->toHaveCount(1);
    expect($user->tokens->first()->name)->toBe('Sshelf Desktop');
});

test('it requires authentication', function () {
    $response = $this->get(route('desktop.login'));

    $response->assertRedirect(route('login'));
});
