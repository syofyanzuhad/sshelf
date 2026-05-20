<div class="flex flex-col lg:flex-row gap-6">
    <!-- Sidebar / Group Selector -->
    <div class="w-full lg:w-64 flex-shrink-0">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
            <h3 class="hidden lg:block text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Groups</h3>
            
            <!-- Mobile Horizontal Scroll for Groups -->
            <div class="flex lg:flex-col overflow-x-auto lg:overflow-x-visible pb-2 lg:pb-0 space-x-2 lg:space-x-0 lg:space-y-1 scrollbar-hide">
                <button wire:click="$set('selectedGroup', '')" 
                    class="whitespace-nowrap flex-shrink-0 text-left px-3 py-2 text-sm font-medium rounded-md {{ $selectedGroup === '' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                    All Servers
                </button>
                @foreach($groups as $group)
                    <button wire:click="$set('selectedGroup', '{{ $group }}')" 
                        class="whitespace-nowrap flex-shrink-0 text-left px-3 py-2 text-sm font-medium rounded-md {{ $selectedGroup === $group ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        <span class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-gray-400 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            {{ $group }}
                        </span>
                    </button>
                @endforeach

                @if($hasUngrouped)
                    <button wire:click="$set('selectedGroup', 'ungrouped_hidden_key')" 
                        class="whitespace-nowrap flex-shrink-0 text-left px-3 py-2 text-sm font-medium rounded-md {{ $selectedGroup === 'ungrouped_hidden_key' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        <span class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-gray-400 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Ungrouped
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 space-y-4">
        @if (session()->has('message'))
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="w-full sm:w-1/3">
                <x-text-input wire:model.live.debounce.300ms="search" type="text" placeholder="Search servers..." class="w-full" />
            </div>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-secondary-button class="w-full sm:w-auto justify-center">
                            Export
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </x-secondary-button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link class="cursor-pointer" wire:click="export">
                            JSON Format
                        </x-dropdown-link>
                        <x-dropdown-link class="cursor-pointer" wire:click="exportCsv">
                            CSV Format
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <x-secondary-button class="flex-1 sm:flex-none justify-center" x-on:click="$dispatch('open-modal', 'server-import-modal')">
                    Import
                </x-secondary-button>
                <x-primary-button class="flex-1 sm:flex-none justify-center" x-data="" x-on:click="Livewire.dispatch('create-server')">
                    Add Server
                </x-primary-button>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Host</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @php $lastGroup = null; @endphp
                    @forelse($servers as $server)
                        @if($server->group !== $lastGroup)
                            <tr class="bg-gray-50 dark:bg-gray-700/50">
                                <td colspan="3" class="px-6 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ $server->group ?? 'Ungrouped' }}
                                </td>
                            </tr>
                            @php $lastGroup = $server->group; @endphp
                        @endif
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $server->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $server->username }}@ {{ $server->host }}:{{ $server->port }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <button wire:click="duplicate({{ $server->id }})" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Duplicate</button>
                                <button x-on:click="Livewire.dispatch('edit-server', { server: {{ $server->id }} })" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">Edit</button>
                                <button wire:click="delete({{ $server->id }})" wire:confirm="Are you sure you want to delete this server?" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                <a href="{{ route('servers.terminal', $server) }}" class="inline-flex items-center px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Terminal
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No servers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @php $lastGroup = null; @endphp
            @forelse($servers as $server)
                @if($server->group !== $lastGroup)
                    <div class="px-1 pt-4 pb-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ $server->group ?? 'Ungrouped' }}
                    </div>
                    @php $lastGroup = $server->group; @endphp
                @endif
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4 space-y-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $server->name }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $server->username }}@ {{ $server->host }}</p>
                        </div>
                        <a href="{{ route('servers.terminal', $server) }}" class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900">
                            Connect
                        </a>
                    </div>
                    
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex space-x-4">
                            <button x-on:click="Livewire.dispatch('edit-server', { server: {{ $server->id }} })" class="text-sm text-blue-600 dark:text-blue-400">Edit</button>
                            <button wire:click="duplicate({{ $server->id }})" class="text-sm text-indigo-600 dark:text-indigo-400">Duplicate</button>
                        </div>
                        <button wire:click="delete({{ $server->id }})" wire:confirm="Are you sure you want to delete this server?" class="text-sm text-red-600 dark:text-red-400">Delete</button>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    No servers found.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $servers->links() }}
        </div>
    </div>
</div>
