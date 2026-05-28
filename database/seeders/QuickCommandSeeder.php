<?php

namespace Database\Seeders;

use App\Models\QuickCommand;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuickCommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin user we created in DatabaseSeeder
        $admin = User::where('email', 'mail@syofyanzuhad.dev')->first();

        if (! $admin) {
            return;
        }

        $commands = [
            [
                'name' => 'Check Disk Space',
                'command' => 'df -h',
            ],
            [
                'name' => 'Check Memory Usage',
                'command' => 'free -m',
            ],
            [
                'name' => 'List Active Docker Containers',
                'command' => 'docker ps',
            ],
            [
                'name' => 'View System Load',
                'command' => 'uptime',
            ],
            [
                'name' => 'Update Packages (Ubuntu/Debian)',
                'command' => 'sudo apt update && sudo apt upgrade -y',
            ],
            [
                'name' => 'Check Active SSH Connections',
                'command' => 'who',
            ],
            [
                'name' => 'Tail Syslog',
                'command' => 'tail -n 50 /var/log/syslog',
            ],
        ];

        foreach ($commands as $command) {
            QuickCommand::updateOrCreate(
                [
                    'user_id' => $admin->id,
                    'name' => $command['name'],
                ],
                [
                    'command' => $command['command'],
                    'server_id' => null, // Global command for this user
                ]
            );
        }
    }
}
