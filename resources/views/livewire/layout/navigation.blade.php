<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center space-x-2 group">
                        <x-application-logo class="w-8 h-8 group-hover:scale-105 transition-transform" />
                        <div class="flex items-center space-x-1">
                            <span class="text-xl font-bold text-gray-800 dark:text-gray-200 tracking-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ config('app.name', 'Sshelf') }}</span>
                            <span class="px-1.5 py-0.5 text-[10px] font-bold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded uppercase">Beta</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('commands')" :active="request()->routeIs('commands')" wire:navigate>
                        {{ __('Commands') }}
                    </x-nav-link>
                    <x-nav-link :href="route('keys')" :active="request()->routeIs('keys')" wire:navigate>
                        {{ __('Keys') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tokens')" :active="request()->routeIs('tokens')" wire:navigate>
                        {{ __('API Tokens') }}
                    </x-nav-link>
                    <x-nav-link :href="route('servers.logs')" :active="request()->routeIs('servers.logs')" wire:navigate>
                        {{ __('Logs') }}
                    </x-nav-link>
                    @can('manage', App\Models\User::class)
                    <x-nav-link :href="route('users')" :active="request()->routeIs('users')" wire:navigate>
                        {{ __('Users') }}
                    </x-nav-link>
                    @endcan
                    <button @click="$dispatch('open-support-modal')" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-red-500 hover:text-red-600 transition duration-150 ease-in-out focus:outline-none">
                        <svg class="w-4 h-4 mr-1.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        {{ __('Support') }}
                    </button>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <x-theme-toggle />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center space-x-2">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                <span class="px-1.5 py-0.5 text-[10px] font-bold {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-900/50 dark:text-gray-400' }} rounded uppercase">
                                    {{ auth()->user()->role->label() }}
                                </span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('commands')" :active="request()->routeIs('commands')" wire:navigate>
                {{ __('Commands') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('keys')" :active="request()->routeIs('keys')" wire:navigate>
                {{ __('Keys') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tokens')" :active="request()->routeIs('tokens')" wire:navigate>
                {{ __('API Tokens') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('servers.logs')" :active="request()->routeIs('servers.logs')" wire:navigate>
                {{ __('Logs') }}
            </x-responsive-nav-link>
            @can('manage', App\Models\User::class)
            <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')" wire:navigate>
                {{ __('Users') }}
            </x-responsive-nav-link>
            @endcan
            <button @click="$dispatch('open-support-modal')" class="flex w-full items-center pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-red-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out focus:outline-none">
                <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                {{ __('Support') }}
            </button>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex justify-between items-center">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
                <x-theme-toggle />
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
