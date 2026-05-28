<?php

namespace App\Console\Commands;

use App\Events\TerminalOutput;
use App\Events\TerminalStatusUpdated;
use App\Models\ConnectionLog;
use App\Models\Server;
use App\Services\SshShellService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SshTerminalCommand extends Command
{
    protected $signature = 'app:ssh-terminal {serverId} {--log-id=}';

    protected $description = 'Maintains an SSH terminal session and broadcasts output.';

    public function handle(SshShellService $sshShellService)
    {
        $serverId = $this->argument('serverId');
        $logId = $this->option('log-id');
        $log = $logId ? ConnectionLog::find($logId) : null;

        // Single instance check per server
        $lockKey = "server.{$serverId}.lock";
        if (! Cache::add($lockKey, true, now()->addMinutes(10))) {
            if ($log) {
                $log->update([
                    'status' => 'failed',
                    'error' => 'Another session is already active for this server.',
                ]);
            }
            $this->error('Another session is already active.');

            return;
        }

        // Record PID so the web app can track us
        Cache::put("server.{$serverId}.worker_pid", getmypid(), now()->addHour());
        Cache::forget("server.{$serverId}.starting");

        try {
            $server = Server::findOrFail($serverId);

            $progressBuffer = [];
            $onProgress = function ($message) use ($serverId, &$progressBuffer) {
                $progressBuffer[] = $message;
                $this->safeDispatch(new TerminalStatusUpdated($serverId, 'connecting', $message));
            };

            $this->safeDispatch(new TerminalStatusUpdated($serverId, 'connecting'));

            if (! $sshShellService->openShell($server, $onProgress)) {
                $this->safeDispatch(new TerminalStatusUpdated($serverId, 'failed', 'Authentication failed or server unreachable.'));
                if ($log) {
                    $log->update([
                        'status' => 'failed',
                        'error' => 'Authentication failed or server unreachable.',
                    ]);
                }

                return;
            }

            $this->safeDispatch(new TerminalStatusUpdated($serverId, 'connected'));

            if ($log) {
                $log->update([
                    'status' => 'connected',
                    'connected_at' => now(),
                ]);
            }

            $inputKey = "server.{$serverId}.input";
            $refreshKey = "server.{$serverId}.refresh";
            $heartbeatKey = "server.{$serverId}.last_heartbeat";
            $buffer = '';

            while ($sshShellService->isConnected()) {
                // Check if a new client requested a refresh
                if (Cache::pull($refreshKey)) {
                    // Replay progress
                    foreach ($progressBuffer as $msg) {
                        $this->safeDispatch(new TerminalStatusUpdated($serverId, 'connecting', $msg));
                    }

                    if ($buffer) {
                        // Send buffer to the new client
                        $this->safeDispatch(new TerminalOutput($serverId, $buffer));
                    }

                    // Also send current status
                    $this->safeDispatch(new TerminalStatusUpdated($serverId, 'connected'));
                }

                // Read from SSH Shell (Output from server)
                $output = $sshShellService->read();
                if ($output) {
                    $buffer .= $output;
                    // Keep buffer from growing indefinitely (keep last 100KB)
                    if (strlen($buffer) > 102400) {
                        $buffer = substr($buffer, -102400);
                    }
                    $this->safeDispatch(new TerminalOutput($serverId, $output));
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
        } catch (\Exception $e) {
            $this->safeDispatch(new TerminalStatusUpdated($serverId, 'failed', $e->getMessage()));
            try {
                if ($log) {
                    $log->update([
                        'status' => 'failed',
                        'error' => $e->getMessage(),
                    ]);
                }
            } catch (\Exception $logException) {
                \Log::error('Failed to update connection log to failed: '.$logException->getMessage());
            }
        } finally {
            $this->safeDispatch(new TerminalStatusUpdated($serverId, 'disconnected'));

            try {
                if ($log) {
                    $log->update([
                        'status' => $log->status === 'failed' ? 'failed' : 'disconnected',
                        'disconnected_at' => now(),
                    ]);
                }
            } catch (\Exception $logException) {
                \Log::error('Failed to update connection log to disconnected: '.$logException->getMessage());
            }

            // Cleanup
            Cache::forget("server.{$serverId}.worker_pid");
            Cache::forget("server.{$serverId}.lock");
        }
    }

    /**
     * Dispatch an event safely, logging failures instead of crashing.
     */
    protected function safeDispatch($event): void
    {
        try {
            event($event);
        } catch (\Exception $e) {
            \Log::warning('Broadcast failed: '.$e->getMessage());
        }
    }
}
