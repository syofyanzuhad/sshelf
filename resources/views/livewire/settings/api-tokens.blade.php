<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">API Tokens</h2>
                        <p class="text-sm text-gray-500">Generate tokens for the CLI Bridge API.</p>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                    <h3 class="text-lg font-medium mb-4">Create New Token</h3>
                    <form wire:submit="createToken" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <x-text-input wire:model="tokenName" type="text" placeholder="Token Name (e.g. Laptop CLI)" class="w-full" />
                            <x-input-error :messages="$errors->get('tokenName')" class="mt-2" />
                        </div>
                        <x-primary-button>Create Token</x-primary-button>
                    </form>

                    @if ($plainTextToken)
                        <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-900/50 rounded-lg">
                            <p class="text-sm text-yellow-800 dark:text-yellow-200 font-bold mb-2">New Token Created:</p>
                            <div class="flex items-center gap-2">
                                <code class="flex-1 p-2 bg-white dark:bg-gray-800 rounded border border-yellow-300 dark:border-yellow-700 text-sm font-mono break-all">
                                    {{ $plainTextToken }}
                                </code>
                                <button 
                                    x-data="{ copied: false }" 
                                    x-on:click="navigator.clipboard.writeText('{{ $plainTextToken }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    type="button"
                                    class="p-2 text-indigo-600 hover:text-indigo-900"
                                >
                                    <span x-show="!copied">Copy</span>
                                    <span x-show="copied" class="text-green-600">Copied!</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 font-semibold">Name</th>
                                <th class="py-3 px-4 font-semibold">Last Used</th>
                                <th class="py-3 px-4 font-semibold">Created</th>
                                <th class="py-3 px-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tokens as $token)
                                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                    <td class="py-3 px-4 font-medium">{{ $token->name }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-500">
                                        {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : 'Never' }}
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-500">
                                        {{ $token->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <button 
                                            wire:click="deleteToken({{ $token->id }})" 
                                            wire:confirm="Are you sure you want to revoke this token?"
                                            class="text-red-600 hover:text-red-900 dark:hover:text-red-400 text-sm"
                                        >
                                            Revoke
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500 italic">No API tokens found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
