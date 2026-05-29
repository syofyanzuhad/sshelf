<?php

namespace App\Livewire\Servers;

use App\Models\ConnectionLog;
use App\Models\Server;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Terminal')]
class ServerTerminal extends Component
{
    public Server $server;

    public function mount(Server $server)
    {
        $this->authorize('view', $server);
        $this->server = $server;

        // Create audit log
        $log = ConnectionLog::create([
            'server_id' => $this->server->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => 'pending',
        ]);

        // Signal open status and heartbeat
        $this->heartbeat();

        // Check if worker is already running or starting
        $isWorkerRunning = Cache::has("server.{$this->server->id}.worker_pid");
        $isWorkerStarting = Cache::has("server.{$this->server->id}.starting");

        if ($isWorkerRunning || $isWorkerStarting) {
            $log->update([
                'status' => 'connected',
                'connected_at' => now(),
            ]);

            // Tell existing worker to refresh the screen
            Cache::put("server.{$this->server->id}.refresh", true, now()->addMinutes(1));
        } else {
            // Mark as starting to prevent race conditions
            Cache::put("server.{$this->server->id}.starting", true, now()->addSeconds(30));

            // Attempt to start the background process using CLI PHP
            $php = config('app.php_binary', PHP_BINARY);

            // If we are in a web context, PHP_BINARY might point to php-fpm.
            // We try to find the CLI version if possible.
            if (str_contains($php, 'fpm')) {
                $php = str_replace('fpm', 'cli', $php);
                if (! file_exists($php)) {
                    $php = 'php'; // Fallback to PATH
                }
            }

            $artisan = base_path('artisan');
            $command = "\"{$php}\" \"{$artisan}\" app:ssh-terminal {$this->server->id} --log-id={$log->id} > /dev/null 2>&1 &";

            try {
                exec($command, $output, $resultCode);
                if ($resultCode !== 0) {
                    \Log::warning("Background worker failed to start with code {$resultCode} for server {$this->server->id}");
                }
            } catch (\Exception $e) {
                \Log::error('Failed to spawn background worker: '.$e->getMessage());
                $log->update([
                    'status' => 'failed',
                    'error' => 'Failed to spawn background worker: '.$e->getMessage(),
                ]);
            }
        }
    }

    public function heartbeat()
    {
        Cache::put("server.{$this->server->id}.status", 'open', now()->addHour());
        Cache::put("server.{$this->server->id}.last_heartbeat", now()->timestamp, now()->addHour());
    }

    public function refresh()
    {
        Cache::put("server.{$this->server->id}.refresh", true, now()->addMinutes(1));
    }

    protected function isProcessRunning($pid)
    {
        return (bool) shell_exec("ps -p {$pid} | grep {$pid}");
    }

    public function sendInput(string $data)
    {
        $inputKey = "server.{$this->server->id}.input";
        Cache::put($inputKey, $data, now()->addMinutes(5));
    }

    public function runCommand(string $command)
    {
        // Append a newline to the command so it executes immediately
        $this->sendInput($command."\n");
    }

    public function disconnect()
    {
        Cache::put("server.{$this->server->id}.status", 'closed');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.servers.server-terminal')
            ->layout('layouts.app');
    }
}
