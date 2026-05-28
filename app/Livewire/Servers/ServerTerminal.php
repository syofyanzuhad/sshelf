<?php

namespace App\Livewire\Servers;

use App\Models\ConnectionLog;
use App\Models\Server;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use Livewire\Component;

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

        // Tell existing worker to refresh the screen if it's already running
        Cache::put("server.{$this->server->id}.refresh", true, now()->addMinutes(1));

        // Attempt to start the background process using CLI PHP
        $php = config('app.php_binary', PHP_BINARY);

        Process::path(base_path())->start([
            $php,
            'artisan',
            'app:ssh-terminal',
            (string) $this->server->id,
            "--log-id={$log->id}",
        ]);
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
