<?php

namespace App\Livewire\Settings;

use App\Models\Server;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('System Diagnostics')]
class SystemDiagnostics extends Component
{
    public array $checks = [];

    public function mount()
    {
        $this->authorize('manage', User::class);
        $this->runDiagnostics();
    }

    public function runDiagnostics()
    {
        $this->checks = [
            'environment' => $this->checkEnvironment(),
            'functions' => $this->checkFunctions(),
            'extensions' => $this->checkExtensions(),
            'database' => $this->checkDatabase(),
            'network' => $this->checkNetwork(),
            'broadcast' => $this->checkBroadcast(),
        ];
    }

    protected function checkEnvironment(): array
    {
        $version = PHP_VERSION;
        $pass = version_compare($version, '8.3.0', '>=');

        return [
            'label' => 'PHP Version',
            'value' => $version,
            'status' => $pass ? 'success' : 'warning',
            'message' => $pass ? 'Meets requirement (>= 8.3)' : 'Recommended version is 8.3 or higher.',
        ];
    }

    protected function checkFunctions(): array
    {
        $required = ['exec', 'proc_open', 'shell_exec'];
        $missing = array_filter($required, fn ($f) => ! function_exists($f));

        return [
            'label' => 'Required Functions',
            'value' => empty($missing) ? 'All enabled' : 'Missing: '.implode(', ', $missing),
            'status' => empty($missing) ? 'success' : 'danger',
            'message' => empty($missing)
                ? 'System functions are available for background workers.'
                : 'Background terminal functionality will be disabled.',
        ];
    }

    protected function checkExtensions(): array
    {
        $required = ['bcmath', 'mbstring', 'openssl', 'curl'];
        $missing = array_filter($required, fn ($e) => ! extension_loaded($e));

        return [
            'label' => 'PHP Extensions',
            'value' => empty($missing) ? 'All loaded' : 'Missing: '.implode(', ', $missing),
            'status' => empty($missing) ? 'success' : 'danger',
            'message' => empty($missing)
                ? 'Core extensions required for SSH are present.'
                : 'SSH connectivity may be unstable or broken.',
        ];
    }

    protected function checkDatabase(): array
    {
        $driver = config('database.default');

        if ($driver === 'sqlite') {
            try {
                $journalMode = DB::selectOne('PRAGMA journal_mode')->journal_mode;
                $pass = $journalMode === 'wal';

                return [
                    'label' => 'SQLite Journal Mode',
                    'value' => strtoupper($journalMode),
                    'status' => $pass ? 'success' : 'warning',
                    'message' => $pass
                        ? 'WAL mode is active (optimized for concurrency).'
                        : 'Recommend switching to WAL mode for better terminal performance.',
                ];
            } catch (\Exception $e) {
                return [
                    'label' => 'Database Check',
                    'value' => 'Error',
                    'status' => 'danger',
                    'message' => 'Could not query database: '.$e->getMessage(),
                ];
            }
        }

        return [
            'label' => 'Database Driver',
            'value' => $driver,
            'status' => 'success',
            'message' => 'Using '.ucfirst($driver).' connection.',
        ];
    }

    protected function checkNetwork(): array
    {
        $host = 'test.rebex.net';
        $port = 22;
        $fp = @fsockopen($host, $port, $errno, $errstr, 3);

        if ($fp) {
            fclose($fp);

            return [
                'label' => 'Outbound SSH (Port 22)',
                'value' => 'Open',
                'status' => 'success',
                'message' => 'The server can connect to external SSH servers.',
            ];
        }

        return [
            'label' => 'Outbound SSH (Port 22)',
            'value' => 'Blocked',
            'status' => 'warning',
            'message' => "Could not reach $host:22 ($errstr). Check firewall or cloud restrictions.",
        ];
    }

    protected function checkBroadcast(): array
    {
        $driver = config('broadcasting.default');
        $isRealtime = in_array($driver, ['reverb', 'pusher', 'soketi']);

        if ($isRealtime) {
            $connection = config("broadcasting.connections.$driver");
            $host = $connection['options']['host'] ?? null;
            $port = $connection['options']['port'] ?? ($connection['options']['scheme'] === 'https' ? 443 : 80);

            if ($host) {
                $fp = @fsockopen($host, $port, $errno, $errstr, 2);
                if ($fp) {
                    fclose($fp);

                    return [
                        'label' => 'Real-time Connection',
                        'value' => ucfirst($driver).' (Connected)',
                        'status' => 'success',
                        'message' => "Successfully reached the $driver server at $host:$port.",
                    ];
                }

                return [
                    'label' => 'Real-time Connection',
                    'value' => ucfirst($driver).' (Unreachable)',
                    'status' => 'danger',
                    'message' => "Could not reach $driver server at $host:$port. This will prevent terminal updates.",
                ];
            }
        }

        return [
            'label' => 'Real-time Driver',
            'value' => ucfirst($driver),
            'status' => $isRealtime ? 'success' : 'warning',
            'message' => $isRealtime
                ? 'Driver is configured, but host is not defined.'
                : 'Interactive terminal requires a WebSocket driver (e.g. Reverb).',
        ];
    }

    public function getTerminalStatus(): array
    {
        $servers = Server::all();
        $status = [];

        foreach ($servers as $server) {
            $pid = Cache::get("server.{$server->id}.worker_pid");
            $lock = Cache::get("server.{$server->id}.lock");
            $starting = Cache::get("server.{$server->id}.starting");
            $heartbeat = Cache::get("server.{$server->id}.last_heartbeat");

            $isAlive = $pid && $this->isProcessRunning($pid);

            if ($pid || $lock || $starting) {
                $status[] = [
                    'id' => $server->id,
                    'name' => $server->name,
                    'pid' => $pid ?? 'N/A',
                    'process_alive' => $isAlive ? 'Yes' : 'No',
                    'lock' => $lock ? 'Active' : 'Missing',
                    'starting' => $starting ? 'Yes' : 'No',
                    'last_heartbeat' => $heartbeat ? Carbon::createFromTimestamp($heartbeat)->diffForHumans() : 'N/A',
                ];
            }
        }

        return $status;
    }

    protected function isProcessRunning($pid): bool
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return false;
        }

        return (bool) shell_exec("ps -p $pid | grep $pid");
    }

    public function cleanupTerminal(int $serverId)
    {
        Cache::forget("server.$serverId.worker_pid");
        Cache::forget("server.$serverId.lock");
        Cache::forget("server.$serverId.starting");
        Cache::forget("server.$serverId.status");
        Cache::forget("server.$serverId.refresh");
        Cache::forget("server.$serverId.input");

        $this->runDiagnostics();
    }

    public function render()
    {
        return view('livewire.settings.system-diagnostics', [
            'terminalStatus' => $this->getTerminalStatus(),
        ])->layout('layouts.app');
    }
}
