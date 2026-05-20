<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('user:promote {email} {--role=admin}')]
#[Description('Promote a user to a specific role')]
class PromoteUserCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->option('role');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("User with email {$email} not found.");

            return 1;
        }

        try {
            $newRole = UserRole::from($role);
        } catch (\ValueError $e) {
            $this->error("Invalid role: {$role}. Valid roles are: admin, viewer.");

            return 1;
        }

        $user->update(['role' => $newRole]);

        $this->info("User {$email} promoted to {$newRole->label()}.");

        return 0;
    }
}
