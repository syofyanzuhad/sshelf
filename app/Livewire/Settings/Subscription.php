<?php

namespace App\Livewire\Settings;

use App\Enums\Plan;
use Illuminate\View\View;
use Livewire\Component;

class Subscription extends Component
{
    /**
     * Get the current user and their plan stats.
     */
    public function render(): View
    {
        $user = auth()->user();
        $owner = $user->owner();

        $plans = [
            Plan::Free->value => [
                'name' => 'Gratis',
                'price' => 'Rp 0',
                'price_usd' => '$0',
                'features' => ['3 Server', '1 SSH Key', '0 Team Members'],
            ],
            Plan::Pro->value => [
                'name' => 'Pro',
                'price' => 'Rp 49.000',
                'price_usd' => '$4',
                'features' => ['20 Server', '5 SSH Keys', '2 Team Members'],
            ],
            Plan::Business->value => [
                'name' => 'Bisnis',
                'price' => 'Rp 149.000',
                'price_usd' => '$12',
                'features' => ['Server Tanpa Batas', 'SSH Keys Tanpa Batas', 'Tim Tanpa Batas'],
            ],
        ];

        $stats = [
            'servers' => [
                'current' => $owner->servers()->count(),
                'limit' => $owner->plan->limits()['servers'],
                'label' => 'Server Terkelola',
            ],
            'ssh_keys' => [
                'current' => $owner->sshKeys()->count(),
                'limit' => $owner->plan->limits()['ssh_keys'],
                'label' => 'SSH Keys',
            ],
            'members' => [
                'current' => $owner->members()->count(),
                'limit' => $owner->plan->limits()['members'],
                'label' => 'Anggota Tim',
            ],
        ];

        return view('livewire.settings.subscription', [
            'owner' => $owner,
            'plans' => $plans,
            'stats' => $stats,
        ])->layout('layouts.app');
    }

    /**
     * Placeholder for the upgrade action.
     */
    public function upgrade(string $plan): void
    {
        // This will be connected to Stripe later
        $this->dispatch('notify', [
            'type' => 'info',
            'message' => "Integrasi pembayaran untuk paket {$plan} sedang disiapkan.",
        ]);
    }
}
