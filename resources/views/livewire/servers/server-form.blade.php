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

                @if($auth_type === 'password')
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" type="password" class="mt-1 block w-full" wire:model="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                @else
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="ssh_key_id" value="Select Saved SSH Key (Optional)" />
                            <select id="ssh_key_id" wire:model.live="ssh_key_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- Use One-time Key --</option>
                                @foreach($sshKeys as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('ssh_key_id')" class="mt-2" />
                        </div>

                        @if(!$ssh_key_id)
                            <div>
                                <x-input-label for="private_key" value="Private Key" />
                                <textarea id="private_key" wire:model="private_key" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5"></textarea>
                                <x-input-error :messages="$errors->get('private_key')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="passphrase" value="Passphrase (Optional)" />
                                <x-text-input id="passphrase" type="password" class="mt-1 block w-full" wire:model="passphrase" />
                                <x-input-error :messages="$errors->get('passphrase')" class="mt-2" />
                            </div>
                        @else
                            <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg border border-indigo-100 dark:border-indigo-800">
                                <div class="flex items-center space-x-2 text-sm text-indigo-700 dark:text-indigo-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Using linked key from your manager.</span>
                                </div>
                            </div>
                        @endif
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

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <x-secondary-button type="button" wire:click="testConnection" wire:loading.attr="disabled" class="w-full sm:w-auto justify-center">
                        Test Connection
                    </x-secondary-button>

                    <div class="flex items-center space-x-3 w-full sm:w-auto">
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'server-form-modal')" class="flex-1 sm:flex-none justify-center">
                            Cancel
                        </x-secondary-button>

                        <x-primary-button class="flex-1 sm:flex-none justify-center">
                            {{ $server ? 'Update' : 'Save' }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </x-modal>
</div>
