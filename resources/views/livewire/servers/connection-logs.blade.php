<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Connection History') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Desktop Table -->
            <div class="hidden md:block">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Server</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">IP Address</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $log->server?->name ?? 'Deleted Server' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $log->ip_address }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $log->created_at->format('M j, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    @if($log->connected_at && $log->disconnected_at)
                                        {{ $log->connected_at->diffForHumans($log->disconnected_at, true, true) }}
                                    @elseif($log->isActive())
                                        <span class="text-green-500 font-medium">Active</span>
                                    @elseif($log->connected_at)
                                        <span class="text-gray-400 italic" title="Background worker is no longer reporting.">Orphaned</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($log->isActive())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Connected
                                        </span>
                                    @elseif($log->status === 'success')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Success
                                        </span>
                                    @elseif($log->status === 'failed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200" title="{{ $log->error }}">
                                            Failed
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            {{ ucfirst($log->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No connection logs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile List -->
            <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($logs as $log)
                    <div class="p-4 space-y-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $log->server?->name ?? 'Deleted Server' }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $log->created_at->format('M j, Y H:i') }}
                                </div>
                            </div>
                            <div>
                                @if($log->isActive())
                                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Connected
                                    </span>
                                @elseif($log->status === 'success')
                                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Success
                                    </span>
                                @elseif($log->status === 'failed')
                                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Failed
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 pt-1">
                            <span>{{ $log->ip_address }}</span>
                            <span>
                                @if($log->connected_at && $log->disconnected_at)
                                    {{ $log->connected_at->diffForHumans($log->disconnected_at, true, true) }}
                                @elseif($log->isActive())
                                    <span class="text-green-500 font-medium">Active</span>
                                @elseif($log->connected_at)
                                    <span class="text-gray-400 italic">Orphaned</span>
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        No connection logs found.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
