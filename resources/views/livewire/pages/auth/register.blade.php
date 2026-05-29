<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Register')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public ?string $invitation = null;

    public function mount(?string $invitation = null): void
    {
        $this->invitation = $invitation ?? request()->query('invitation');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Handle Invitation
        $parent_id = null;
        if (config('sshelf.mode') === 'saas' && $this->invitation) {
            $invite = \App\Models\Invitation::where('token', $this->invitation)->first();
            if ($invite && $invite->isValid()) {
                $parent_id = $invite->user_id;
                $validated['role'] = $invite->role;
                $invite->update(['accepted_at' => now(), 'email' => $validated['email']]);
            }
        }

        $user = User::create(array_merge($validated, ['parent_id' => $parent_id]));

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Create an account</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Get started with Sshelf today.</p>
    </div>

    @if($invitation)
        @php
            $invite = \App\Models\Invitation::where('token', $invitation)->first();
        @endphp
        @if($invite && $invite->isValid())
            <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 rounded-xl flex items-center space-x-3">
                <div class="bg-indigo-100 dark:bg-indigo-900/50 p-2 rounded-lg text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-indigo-900 dark:text-indigo-400 uppercase tracking-widest">Team Invitation</p>
                    <p class="text-xs text-indigo-700 dark:text-indigo-300">You are joining <strong>{{ $invite->inviter->name }}'s</strong> team.</p>
                </div>
            </div>
        @endif
    @endif

    <form wire:submit="register" class="space-y-5">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900/50" type="text" name="name" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900/50" type="email" name="email" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900/50"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900/50"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 dark:focus:ring-offset-gray-900 transition-all active:scale-[0.98]">
                <span wire:loading.remove wire:target="register">{{ __('Sign up') }}</span>
                <span wire:loading wire:target="register" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Creating account...
                </span>
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 transition-colors" wire:navigate>Sign in</a>
        </p>
    </form>
</div>
