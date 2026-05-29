<?php

namespace App\Livewire\Settings;

use App\Enums\Plan;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Subscription')]
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
                'name' => [
                    'IDR' => 'Gratis',
                    'USD' => 'Free',
                ],
                'price' => 'Rp 0',
                'price_usd' => '$0',
                'features' => [
                    'IDR' => ['3 Server', '1 SSH Key', '0 Anggota Tim'],
                    'USD' => ['3 Servers', '1 SSH Key', '0 Team Members'],
                ],
            ],
            Plan::Pro->value => [
                'name' => [
                    'IDR' => 'Pro',
                    'USD' => 'Pro',
                ],
                'price' => 'Rp 49.000',
                'price_usd' => '$4',
                'features' => [
                    'IDR' => ['20 Server', '5 SSH Keys', '2 Anggota Tim'],
                    'USD' => ['20 Servers', '5 SSH Keys', '2 Team Members'],
                ],
            ],
            Plan::Business->value => [
                'name' => [
                    'IDR' => 'Bisnis',
                    'USD' => 'Business',
                ],
                'price' => 'Rp 149.000',
                'price_usd' => '$12',
                'features' => [
                    'IDR' => ['Server Tanpa Batas', 'SSH Keys Tanpa Batas', 'Tim Tanpa Batas'],
                    'USD' => ['Unlimited Servers', 'Unlimited SSH Keys', 'Unlimited Team'],
                ],
            ],
        ];

        $stats = [
            'servers' => [
                'current' => $owner->servers()->count(),
                'limit' => $owner->plan->limits()['servers'],
                'label' => [
                    'IDR' => 'Server Terkelola',
                    'USD' => 'Managed Servers',
                ],
            ],
            'ssh_keys' => [
                'current' => $owner->sshKeys()->count(),
                'limit' => $owner->plan->limits()['ssh_keys'],
                'label' => [
                    'IDR' => 'SSH Keys',
                    'USD' => 'SSH Keys',
                ],
            ],
            'members' => [
                'current' => $owner->members()->count(),
                'limit' => $owner->plan->limits()['members'],
                'label' => [
                    'IDR' => 'Anggota Tim',
                    'USD' => 'Team Members',
                ],
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
