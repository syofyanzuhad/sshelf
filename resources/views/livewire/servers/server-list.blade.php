<div class="flex flex-col lg:flex-row gap-6">
    <!-- Sidebar / Group Selector -->
    <div class="w-full lg:w-64 flex-shrink-0">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
            <h3 class="hidden lg:block text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Groups</h3>
            
            <div class="flex lg:flex-col overflow-x-auto lg:overflow-x-visible pb-2 lg:pb-0 space-x-2 lg:space-x-0 lg:space-y-1 scrollbar-hide">
                <button wire:click="$set('selectedGroup', '')" 
                    class="whitespace-nowrap flex-shrink-0 text-left px-3 py-2 text-sm font-medium rounded-md {{ $selectedGroup === '' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                    All Servers
                </button>
                @foreach($groups as $group)
                    <button wire:click="$set('selectedGroup', '{{ $group }}')" 
                        class="whitespace-nowrap flex-shrink-0 text-left px-3 py-2 text-sm font-medium rounded-md {{ $selectedGroup === $group ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        {{ $group }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="w-full sm:w-1/3">
                <x-text-input wire:model.live.debounce.300ms="search" type="text" placeholder="Search servers..." class="w-full" />
            </div>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                @can('create', App\Models\Server::class)
                <x-primary-button class="flex-1 sm:flex-none justify-center" x-on:click="Livewire.dispatch('create-server')">
                    Add Server Metadata
                </x-primary-button>
                @endcan
            </div>
        </div>

        <div class="hidden md:block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Host</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($servers as $server)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $server->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $server->username }}@ {{ $server->host }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="text-xs text-gray-400 italic">Manage via Desktop</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                @can('update', $server)
                                <button x-on:click="Livewire.dispatch('edit-server', { server: {{ $server->id }} })" class="text-blue-600 dark:text-blue-400 hover:text-blue-900">Edit Name</button>
                                @endcan
                                @can('delete', $server)
                                <button wire:click="delete({{ $server->id }})" wire:confirm="Are you sure?" class="text-red-600 dark:text-red-400">Delete</button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No servers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @forelse($servers as $server)
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $server->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $server->username }}@ {{ $server->host }}</p>
                    <div class="mt-3 flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-3">
                        <div class="flex gap-4">
                            @can('update', $server)
                            <button x-on:click="Livewire.dispatch('edit-server', { server: {{ $server->id }} })" class="text-xs text-blue-600">Edit Name</button>
                            @endcan
                        </div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold">Desktop Required to Connect</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">No servers found.</div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $servers->links() }}
        </div>
    </div>
</div>
