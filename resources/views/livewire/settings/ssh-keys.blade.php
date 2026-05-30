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
                        Add Key Metadata
                    </x-primary-button>
                    @endcan
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 font-semibold">Name</th>
                                <th class="py-3 px-4 font-semibold">Fingerprint Status</th>
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
                                            {{ $key->public_key ? 'Public Key Set' : 'Metadata Only' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $key->servers()->count() }} Servers
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right space-x-2">
                                        @can('update', $key)
                                        <button wire:click="edit({{ $key->id }})" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">Edit Name</button>
                                        @endcan
                                        @can('delete', $key)
                                        <button wire:click="delete({{ $key->id }})" wire:confirm="Are you sure you want to delete this key?" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">No SSH keys found.</td>
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
                {{ $editing ? 'Edit SSH Key Metadata' : 'New SSH Key Metadata' }}
            </h2>

            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="name" value="Key Name" />
                    <x-text-input wire:model="name" id="name" type="text" class="mt-1 block w-full" placeholder="e.g. My Production Key" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="public_key" value="Public Key (Optional)" />
                    <textarea wire:model="public_key" id="public_key" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 font-mono text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="ssh-ed25519 AAAAC3Nza..."></textarea>
                    <x-input-error :messages="$errors->get('public_key')" class="mt-2" />
                </div>

                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-emerald-800 dark:text-emerald-400">Desktop Vault Required</h3>
                            <p class="mt-1 text-xs text-emerald-700 dark:text-emerald-500 leading-relaxed">
                                Private keys and passphrases can only be added via the <strong>Sshelf Desktop App</strong>. 
                                This ensures they are encrypted using your local vault password before they reach our servers.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    Save Metadata
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
