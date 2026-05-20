<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">Quick Commands</h2>
                        <p class="text-sm text-gray-500">Save and execute frequently used snippets.</p>
                    </div>
                    <x-primary-button wire:click="create">
                        Add Command
                    </x-primary-button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 font-semibold">Name</th>
                                <th class="py-3 px-4 font-semibold">Command</th>
                                <th class="py-3 px-4 font-semibold">Scope</th>
                                <th class="py-3 px-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quickCommands as $cmd)
                                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                    <td class="py-3 px-4">{{ $cmd->name }}</td>
                                    <td class="py-3 px-4">
                                        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded text-xs font-mono text-indigo-600 dark:text-indigo-400">
                                            {{ Str::limit($cmd->command, 40) }}
                                        </code>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($cmd->server)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $cmd->server->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                Global
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right space-x-2">
                                        <button wire:click="edit({{ $cmd->id }})" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">Edit</button>
                                        <button wire:click="delete({{ $cmd->id }})" wire:confirm="Are you sure you want to delete this command?" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">No quick commands found. Click "Add Command" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $quickCommands->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="quick-command-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $editing ? 'Edit Quick Command' : 'New Quick Command' }}
            </h2>

            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" placeholder="e.g. Restart Nginx" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="command" value="Command" />
                    <textarea wire:model="command" id="command" name="command" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="sudo systemctl restart nginx"></textarea>
                    <x-input-error :messages="$errors->get('command')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="server_id" value="Server Scope (Optional)" />
                    <select wire:model="server_id" id="server_id" name="server_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Global (All Servers)</option>
                        @foreach($servers as $server)
                            <option value="{{ $server->id }}">{{ $server->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('server_id')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    Save Command
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
