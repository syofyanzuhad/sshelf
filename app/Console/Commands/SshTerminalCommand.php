<?php

namespace App\Console\Commands;

use App\Events\TerminalOutput;
use App\Models\Server;
use App\Services\SshShellService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use phpseclib3\Net\SSH2;

class SshTerminalCommand extends Command
{
    protected $signature = 'app:ssh-terminal {serverId}';

    protected $description = 'Maintains an SSH terminal session and broadcasts output.';

    public function handle(SshShellService $sshShellService)
    {
        $serverId = $this->argument('serverId');
        
        // Single instance check per server
        $lockKey = "server.{$serverId}.lock";
        if (! Cache::add($lockKey, true, now()->addMinutes(10))) {
            return;
        }

        // Record PID so the web app can track us
        Cache::put("server.{$serverId}.worker_pid", getmypid(), now()->addHour());

        try {
            $server = Server::findOrFail($serverId);
        } catch (\Exception $e) {
            return;
        }

        if (! $sshShellService->openShell($server)) {
            return;
        }

        $inputKey = "server.{$serverId}.input";
        $refreshKey = "server.{$serverId}.refresh";
        $heartbeatKey = "server.{$serverId}.last_heartbeat";
        $buffer = "";

        while ($sshShellService->isConnected()) {
            // Read from SSH
            $output = $sshShellService->read();
            if ($output) {
                TerminalOutput::dispatch($serverId, $output);
                
                // Keep last 2000 chars in buffer for new connects
                $buffer .= $output;
                if (strlen($buffer) > 2000) {
                    $buffer = substr($buffer, -2000);
                }
            }

            // Check if a new client requested a refresh
            if (Cache::pull($refreshKey)) {
                if ($buffer) {
                    // Send buffer to the new client
                    TerminalOutput::dispatch($serverId, $buffer);
                }
            }

            // Read from Cache (Input from user)
            $input = Cache::pull($inputKey);
            if ($input) {
                $sshShellService->write($input);
            }

            // Check for heartbeat (exit if no heartbeat for 30 seconds)
            $lastHeartbeat = Cache::get($heartbeatKey);
            if ($lastHeartbeat && (now()->timestamp - $lastHeartbeat > 30)) {
                break;
            }

            // Check if process should end (explicitly closed)
            if (Cache::get("server.{$serverId}.status") === 'closed') {
                break;
            }

            usleep(10000); // 10ms
        }

        // Cleanup
        Cache::forget("server.{$serverId}.worker_pid");
        Cache::forget("server.{$serverId}.lock");
    }
}
