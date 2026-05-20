<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">User Management</h2>
                        <p class="text-sm text-gray-500">Manage user roles and platform access.</p>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 font-semibold">Name</th>
                                <th class="py-3 px-4 font-semibold">Email</th>
                                <th class="py-3 px-4 font-semibold">Role</th>
                                <th class="py-3 px-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-gray-500">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <span class="px-2 py-1 text-xs font-bold rounded uppercase {{ $user->isAdmin() ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-900/50 dark:text-gray-400' }}">
                                                {{ $user->role->label() }}
                                            </span>
                                            
                                            @if(auth()->id() !== $user->id)
                                                <select 
                                                    wire:change="changeRole({{ $user->id }}, $event.target.value)"
                                                    class="text-xs bg-transparent border-none focus:ring-0 cursor-pointer text-indigo-600 dark:text-indigo-400 p-0"
                                                >
                                                    <option value="" disabled selected>Change...</option>
                                                    @foreach($roles as $role)
                                                        @if($role !== $user->role)
                                                            <option value="{{ $role->value }}">{{ $role->label() }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        @if(auth()->id() !== $user->id)
                                            <button 
                                                wire:click="delete({{ $user->id }})" 
                                                wire:confirm="Are you sure you want to delete this user? All their servers and keys will be inaccessible if not shared."
                                                class="text-red-600 hover:text-red-900 dark:hover:text-red-400 text-sm font-medium"
                                            >
                                                Delete
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Current User</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
