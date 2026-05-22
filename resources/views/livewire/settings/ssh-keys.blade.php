<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">SSH Keys</h2>
                        <p class="text-sm text-gray-500">Manage your SSH keys for server authentication.</p>
                    </div>
                    @can('create', App\Models\SshKey::class)
                    <x-primary-button wire:click="create">
                        Add SSH Key
                    </x-primary-button>
                    @endcan
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 font-semibold">Name</th>
                                <th class="py-3 px-4 font-semibold">Fingerprint</th>
                                <th class="py-3 px-4 font-semibold">Servers</th>
                                <th class="py-3 px-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sshKeys as $key)
                                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                    <td class="py-3 px-4">{{ $key->name }}</td>
                                    <td class="py-3 px-4">
                                        <span class="text-xs font-mono text-gray-500">
                                            {{ $key->public_key ? 'Available' : 'Private Only' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $key->servers_count ?? $key->servers()->count() }} Servers
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right space-x-2">
                                        @can('update', $key)
                                        <button wire:click="edit({{ $key->id }})" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">Edit</button>
                                        @endcan
                                        @can('delete', $key)
                                        <button wire:click="delete({{ $key->id }})" wire:confirm="Are you sure you want to delete this SSH key? Servers using this key will no longer be able to connect." class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">No SSH keys found. Click "Add SSH Key" to create or generate one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $sshKeys->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="ssh-key-modal" :show="$errors->isNotEmpty()" maxWidth="2xl" focusable>
        <form wire:submit="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $editing ? 'Edit SSH Key' : 'New SSH Key' }}
            </h2>

            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" placeholder="e.g. My Production Key" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <x-input-label for="private_key" value="Private Key" />
                    <button type="button" wire:click="generateKeyPair" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold">
                        Generate Key Pair
                    </button>
                </div>
                <div>
                    <textarea wire:model="private_key" id="private_key" name="private_key" rows="6" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 font-mono text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="-----BEGIN OPENSSH PRIVATE KEY-----"></textarea>
                    <x-input-error :messages="$errors->get('private_key')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="public_key" value="Public Key (Optional)" />
                    <textarea wire:model="public_key" id="public_key" name="public_key" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 font-mono text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="ssh-ed25519 AAAAC3Nza..."></textarea>
                    <x-input-error :messages="$errors->get('public_key')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="passphrase" value="Key Passphrase (Optional)" />
                    <div class="relative mt-1" x-data="{ show: false }">
                        <x-text-input wire:model="passphrase" id="passphrase" name="passphrase" x-bind:type="show ? 'text' : 'password'" class="block w-full pr-10" placeholder="If the key is encrypted" />
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors focus:outline-none"
                                @click="show = !show"
                                title="Toggle passphrase visibility">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.443.218 3.512.612M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9l12-12" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('passphrase')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    Save SSH Key
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
