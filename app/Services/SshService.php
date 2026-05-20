<?php

namespace App\Services;

use App\Models\Server;
use phpseclib3\Crypt\Common\PrivateKey;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SSH2;

class SshService
{
    public function testConnection(Server $server): array
    {
        try {
            $ssh = $this->createSshInstance($server->host, (int) $server->port);

            $auth = $server->auth_type === 'password'
                ? $ssh->login($server->username, $server->password)
                : $ssh->login($server->username, $this->loadKey($server));

            return [
                'success' => $auth,
                'message' => $auth ? 'Connected successfully' : 'Authentication failed',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    protected function createSshInstance(string $host, int $port): SSH2
    {
        return new SSH2($host, $port, timeout: 5);
    }

    public function loadKey(Server $server): PrivateKey
    {
        $privateKeyString = $server->sshKey ? $server->sshKey->private_key : $server->private_key;
        $passphrase = $server->sshKey ? $server->sshKey->passphrase : $server->passphrase;

        $key = PublicKeyLoader::load($privateKeyString);

        if ($passphrase) {
            $key = $key->withPassword($passphrase);
        }

        return $key;
    }
}
