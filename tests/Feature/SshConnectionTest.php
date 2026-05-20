<?php

use App\Models\Server;
use App\Models\User;
use App\Services\SshService;
use phpseclib3\Net\SSH2;

test('ssh service can be instantiated', function () {
    $service = new SshService;
    expect($service)->toBeInstanceOf(SshService::class);
});

test('it can handle test connection failure with invalid host', function () {
    $user = User::factory()->create();
    $server = new Server([
        'user_id' => $user->id,
        'name' => 'Test Server',
        'host' => 'invalid-host-that-should-fail',
        'port' => 22,
        'username' => 'testuser',
        'auth_type' => 'password',
        'password' => 'secret',
    ]);

    $service = new SshService;
    $result = $service->testConnection($server);

    expect($result['success'])->toBeFalse();
    $msg = $result['message'];
    $found = str_contains($msg, 'Connection refused') ||
             str_contains($msg, 'Connection timed out') ||
             str_contains($msg, 'php_network_getaddresses') ||
             preg_match('/getaddrinfo.*failed/i', $msg);
    expect($found)->toBeTrue();
});

test('it can handle authentication failure', function () {
    // We'll mock SshService to return a mocked SSH2 instance
    $sshMock = Mockery::mock(SSH2::class);
    $sshMock->shouldReceive('login')->andReturn(false);

    $serviceMock = Mockery::mock(SshService::class)->makePartial()->shouldAllowMockingProtectedMethods();
    $serviceMock->shouldReceive('createSshInstance')->andReturn($sshMock);

    $server = new Server([
        'host' => 'localhost',
        'port' => 22,
        'username' => 'test',
        'auth_type' => 'password',
        'password' => 'wrong',
    ]);

    $result = $serviceMock->testConnection($server);

    expect($result['success'])->toBeFalse();
    expect($result['message'])->toBe('Authentication failed');
});

test('it can handle successful authentication', function () {
    $sshMock = Mockery::mock(SSH2::class);
    $sshMock->shouldReceive('login')->andReturn(true);

    $serviceMock = Mockery::mock(SshService::class)->makePartial()->shouldAllowMockingProtectedMethods();
    $serviceMock->shouldReceive('createSshInstance')->andReturn($sshMock);

    $server = new Server([
        'host' => 'localhost',
        'port' => 22,
        'username' => 'test',
        'auth_type' => 'password',
        'password' => 'correct',
    ]);

    $result = $serviceMock->testConnection($server);

    expect($result['success'])->toBeTrue();
    expect($result['message'])->toBe('Connected successfully');
});
