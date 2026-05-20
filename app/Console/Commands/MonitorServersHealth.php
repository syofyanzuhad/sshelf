<?php

namespace App\Console\Commands;

use App\Jobs\CheckServerHealth;
use App\Models\Server;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('servers:monitor')]
#[Description('Dispatch health check jobs for all servers')]
class MonitorServersHealth extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $servers = Server::all();

        $this->info("Dispatching health checks for {$servers->count()} servers...");

        foreach ($servers as $server) {
            CheckServerHealth::dispatch($server);
        }

        $this->info('All health checks dispatched.');
    }
}
