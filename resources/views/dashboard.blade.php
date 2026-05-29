<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Servers') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Support Banner -->
            <div x-data="{}" class="bg-indigo-600 rounded-xl p-4 text-white flex flex-col sm:flex-row justify-between items-center gap-4 shadow-lg shadow-indigo-500/20">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold">Enjoying Sshelf?</h4>
                        <p class="text-sm text-indigo-100">Support the project and help keep it open-source.</p>
                    </div>
                </div>
                <button @click="$dispatch('open-support-modal')" class="bg-white text-indigo-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-50 transition shrink-0">
                    Support the Project
                </button>
            </div>

            <livewire:servers.server-list />
            <livewire:servers.server-form />
            <livewire:servers.server-import />
        </div>
    </div>
</x-app-layout>
