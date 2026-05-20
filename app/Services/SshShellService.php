<?php

namespace App\Services;

use App\Models\Server;
use phpseclib3\Net\SSH2;

class SshShellService
{
    private SSH2 $ssh;

    public function openShell(Server $server): bool
    {
        $this->ssh = $this->createSshInstance($server->host, (int) $server->port);
        
        // Ensure we have a reasonable timeout for the initial connection
        $this->ssh->setTimeout(10);

        try {
            $auth = $server->auth_type === 'password'
                ? $this->ssh->login($server->username, $server->password)
                : $this->ssh->login($server->username, app(SshService::class)->loadKey($server));

            if (! $auth) {
                return false;
            }

            $this->ssh->enablePTY();
            
            if ($this->ssh->openShell()) {
                // Once open, we use a very short timeout for the interactive loop
                $this->ssh->setTimeout(0.1);
                return true;
            }
        } catch (\Exception $e) {
            \Log::error("SSH Error for server {$server->id}: " . $e->getMessage());
        }

        return false;
    }

    public function isConnected(): bool
    {
        return isset($this->ssh) && $this->ssh->isConnected();
    }

    protected function createSshInstance(string $host, int $port): SSH2
    {
        return new SSH2($host, $port);
    }

    public function write(string $input): void
    {
        if (isset($this->ssh)) {
            $this->ssh->write($input);
        }
    }

    public function read(): string
    {
        if (! isset($this->ssh) || ! $this->ssh->isConnected()) {
            return '';
        }

        $output = $this->ssh->read('', SSH2::READ_NEXT);

        if ($output === false || $output === true) {
            return '';
        }

        return (string) $output;
    }

    public function getSsh(): SSH2
    {
        return $this->ssh;
    }
}
