<div>
    <x-modal name="server-import-modal">
        <div class="p-6" x-data="{ tab: 'file' }">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Import Servers
            </h2>

            <!-- Tabs -->
            <div class="mt-4 border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8">
                    <button @click="tab = 'file'" 
                        :class="tab === 'file' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        JSON / CSV File
                    </button>
                    <button @click="tab = 'ssh'" 
                        :class="tab === 'ssh' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        SSH Config
                    </button>
                </nav>
            </div>

            <!-- Tab Content: File -->
            <div x-show="tab === 'file'" class="mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Upload a JSON or CSV file containing your server credentials.
                </p>
                <input type="file" wire:model="file" class="block w-full text-sm text-gray-500 dark:text-gray-400
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100" />
                
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                
                <div class="mt-6 flex justify-end space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'server-import-modal')">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button wire:click="importFile" wire:loading.attr="disabled">
                        <span wire:loading.remove>Import File</span>
                        <span wire:loading>Importing...</span>
                    </x-primary-button>
                </div>
            </div>

            <!-- Tab Content: SSH Config -->
            <div x-show="tab === 'ssh'" class="mt-6" x-cloak>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Paste the content of your <code>~/.ssh/config</code> file.
                </p>
                <textarea wire:model="sshConfig" rows="10" 
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                    placeholder="Host my-server
    HostName 1.2.3.4
    User root"></textarea>
                
                <x-input-error :messages="$errors->get('sshConfig')" class="mt-2" />

                <div class="mt-6 flex justify-end space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'server-import-modal')">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button wire:click="importSshConfig" wire:loading.attr="disabled">
                        <span wire:loading.remove>Import Config</span>
                        <span wire:loading>Importing...</span>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </x-modal>
</div>
