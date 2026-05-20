<?php

namespace App\Jobs;

use App\Events\ServerHealthUpdated;
use App\Models\Server;
use App\Services\SshService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckServerHealth implements ShouldQueue
{
    use Queueable;

    public $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct(public Server $server) {}

    /**
     * Execute the job.
     */
    public function handle(SshService $sshService): void
    {
        $command = <<<'EOF'
cpu=$(top -bn1 | grep "Cpu(s)" | awk '{print $2 + $4}')
mem=$(free | awk '/Mem:/ {printf "%.2f", $3/$2 * 100}')
disk=$(df / | awk 'NR==2 {print $5}' | sed 's/%//')
echo "CPU:$cpu"
echo "MEM:$mem"
echo "DSK:$disk"
EOF;

        $result = $sshService->executeCommand($this->server, $command);

        if (! $result['success']) {
            $this->server->update([
                'status' => 'offline',
                'last_checked_at' => now(),
            ]);

            ServerHealthUpdated::dispatch($this->server->id, [
                'status' => 'offline',
                'cpu' => null,
                'memory' => null,
                'disk' => null,
            ]);

            return;
        }

        $output = $result['output'];

        $cpu = $this->extractMetric($output, 'CPU:');
        $mem = $this->extractMetric($output, 'MEM:');
        $disk = $this->extractMetric($output, 'DSK:');

        $this->server->update([
            'status' => 'online',
            'last_checked_at' => now(),
            'cpu_usage' => $cpu !== null ? (float) $cpu : null,
            'memory_usage' => $mem !== null ? (float) $mem : null,
            'disk_usage' => $disk !== null ? (float) $disk : null,
        ]);

        ServerHealthUpdated::dispatch($this->server->id, [
            'status' => 'online',
            'cpu' => $this->server->cpu_usage,
            'memory' => $this->server->memory_usage,
            'disk' => $this->server->disk_usage,
        ]);
    }

    protected function extractMetric(string $output, string $prefix): ?string
    {
        if (preg_match('/'.preg_quote($prefix, '/').'([0-9.]+)/', $output, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
