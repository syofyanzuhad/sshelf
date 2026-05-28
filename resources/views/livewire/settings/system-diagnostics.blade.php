<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('System Diagnostics') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium">{{ __('System Health Check') }}</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Verify that your server environment meets the requirements for Sshelf.') }}
                        </p>
                    </div>
                    <button wire:click="runDiagnostics" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <svg wire:loading class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Re-run Checks') }}
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($checks as $key => $check)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $check['label'] }}</span>
                                    <span @class([
                                        'flex-shrink-0 inline-block px-2 py-0.5 text-xs font-medium rounded-full',
                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400' => $check['status'] === 'success',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-400' => $check['status'] === 'warning',
                                        'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-400' => $check['status'] === 'danger',
                                    ])>
                                        {{ strtoupper($check['status']) }}
                                    </span>
                                </div>
                                <div class="text-2xl font-bold mb-1">
                                    {{ $check['value'] }}
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $check['message'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h4 class="font-medium mb-4">{{ __('Common Fixes') }}</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-full text-xs font-bold mr-3">1</span>
                            <div>
                                <p class="font-semibold">{{ __('Enable SQLite WAL Mode') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ __('Run `sqlite3 database/database.sqlite "PRAGMA journal_mode=WAL;"` via terminal.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-full text-xs font-bold mr-3">2</span>
                            <div>
                                <p class="font-semibold">{{ __('Configure Reverb') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ __('Ensure `BROADCAST_CONNECTION=reverb` is set in your .env file and the server is running.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-full text-xs font-bold mr-3">3</span>
                            <div>
                                <p class="font-semibold">{{ __('Whitelist Outbound IPs') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ __('If "Blocked", check your cloud provider firewall or NAT gateway settings.') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
