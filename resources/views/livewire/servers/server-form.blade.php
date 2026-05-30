<div>
    <x-modal name="server-form-modal" wire:model="showModal">
        <form wire:submit.prevent="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $server ? 'Edit Server' : 'Add New Server' }}
            </h2>

            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="name" value="Server Name" />
                    <x-text-input id="name" type="text" class="mt-1 block w-full" wire:model="name" placeholder="Prod API Server" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="host" value="Host (IP or Domain)" />
                        <x-text-input id="host" type="text" class="mt-1 block w-full" wire:model="host" placeholder="192.168.1.10" />
                        <x-input-error :messages="$errors->get('host')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="port" value="Port" />
                        <x-text-input id="port" type="number" class="mt-1 block w-full" wire:model="port" />
                        <x-input-error :messages="$errors->get('port')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="username" value="Username" />
                    <x-text-input id="username" type="text" class="mt-1 block w-full" wire:model="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="auth_type" value="Authentication Type" />
                    <select id="auth_type" wire:model.live="auth_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="password">Password</option>
                        <option value="key">SSH Key</option>
                    </select>
                    <x-input-error :messages="$errors->get('auth_type')" class="mt-2" />
                </div>

                <!-- E2EE Notice -->
                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-emerald-800 dark:text-emerald-400">End-to-End Encrypted</h3>
                            <p class="mt-1 text-xs text-emerald-700 dark:text-emerald-500 leading-relaxed">
                                For your security, passwords and private keys can only be managed via the 
                                <strong class="text-emerald-900 dark:text-emerald-300">Sshelf Desktop App</strong>. 
                                Metadata synced from this web dashboard is automatically protected with your local vault password.
                            </p>
                        </div>
                    </div>
                </div>

                @if($auth_type === 'key')
                    <div>
                        <x-input-label for="ssh_key_id" value="Select Saved SSH Key (Optional)" />
                        <select id="ssh_key_id" wire:model.live="ssh_key_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- Use One-time Key (Desktop Only) --</option>
                            @foreach($sshKeys as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('ssh_key_id')" class="mt-2" />
                    </div>
                @endif

                <div>
                    <x-input-label for="group" value="Group / Folder" />
                    <x-text-input id="group" type="text" class="mt-1 block w-full" wire:model="group" placeholder="Production" list="groups-list" />
                    <datalist id="groups-list">
                        @foreach($groups as $existingGroup)
                            <option value="{{ $existingGroup }}">
                        @endforeach
                    </datalist>
                    <x-input-error :messages="$errors->get('group')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="notes" value="Notes" />
                    <textarea id="notes" wire:model="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3"></textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex flex-col-reverse sm:flex-row justify-between items-center gap-4">
                <div class="w-full sm:w-auto text-center sm:text-left">
                    @if (session()->has('message'))
                        <span class="text-green-600 dark:text-green-400 text-sm">{{ session('message') }}</span>
                    @endif
                    @if (session()->has('error'))
                        <span class="text-red-600 dark:text-red-400 text-sm">{{ session('error') }}</span>
                    @endif
                </div>

                <div class="flex items-center space-x-3 w-full sm:w-auto">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'server-form-modal')" class="flex-1 sm:flex-none justify-center">
                        Cancel
                    </x-secondary-button>

                    <x-primary-button class="flex-1 sm:flex-none justify-center">
                        {{ $server ? 'Update Metadata' : 'Save Metadata' }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-modal>
</div>
