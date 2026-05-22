<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">{{ config('sshelf.mode') === 'saas' ? 'Team Management' : 'User Management' }}</h2>
                        <p class="text-sm text-gray-500">{{ config('sshelf.mode') === 'saas' ? 'Manage your team members and invites.' : 'Manage user roles and platform access.' }}</p>
                    </div>

                    @if(config('sshelf.mode') === 'saas')
                        <button 
                            wire:click="generateInvitationLink"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-lg shadow-indigo-500/20 active:scale-95"
                        >
                            Invite Member
                        </button>
                    @endif
                </div>

                @if($invitationLink)
                    <div class="mb-8 p-6 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl border border-indigo-100 dark:border-indigo-800/50">
                        <h4 class="text-sm font-bold text-indigo-900 dark:text-indigo-400 uppercase tracking-widest mb-3">New Invitation Link</h4>
                        <div class="flex items-center space-x-3">
                            <input type="text" readonly value="{{ $invitationLink }}" class="flex-grow bg-white dark:bg-gray-900 border-indigo-200 dark:border-indigo-800 rounded-xl text-sm px-4 py-2.5 font-mono text-gray-600 dark:text-gray-300">
                            <button 
                                x-data="{ copied: false }"
                                @click="navigator.clipboard.writeText('{{ $invitationLink }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="bg-white dark:bg-gray-800 border border-indigo-200 dark:border-indigo-800 text-indigo-600 dark:text-indigo-400 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-indigo-50 dark:hover:bg-gray-700 transition"
                            >
                                <span x-show="!copied">Copy Link</span>
                                <span x-show="copied" class="text-green-600">Copied!</span>
                            </button>
                        </div>
                        <p class="text-[10px] text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-widest mt-3 flex items-center">
                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Expires in 7 days
                        </p>
                    </div>
                @endif

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
