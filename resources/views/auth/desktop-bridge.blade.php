<x-guest-layout title="Desktop Login">
    <div class="text-center" x-data="{ 
        launched: false,
        showManual: false,
        copy(text) {
            navigator.clipboard.writeText(text);
        }
    }" x-init="setTimeout(() => { 
        window.location.href = '{{ $deeplink }}';
        launched = true;
    }, 1000)">
        
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                Launching Sshelf Desktop
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Connecting your account to the desktop application...
            </p>
        </div>

        <!-- Animation/Status -->
        <div class="flex justify-center py-8">
            <div class="relative">
                <div class="w-16 h-16 border-4 border-indigo-100 dark:border-indigo-900/30 rounded-full"></div>
                <div class="absolute top-0 left-0 w-16 h-16 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin" x-show="!launched"></div>
                <div class="absolute top-0 left-0 w-16 h-16 flex items-center justify-center" x-show="launched" x-cloak>
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="{{ $deeplink }}" class="inline-flex w-full justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-lg shadow-indigo-500/20">
                Open Sshelf Desktop
            </a>
            
            <button @click="showManual = !showManual" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition underline decoration-dotted underline-offset-4">
                Trouble opening the app?
            </button>
        </div>

        <!-- Manual Fallback -->
        <div x-show="showManual" x-collapse x-cloak class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800 text-left">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Manual Configuration</p>
            
            <div class="space-y-4">
                <!-- API URL -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Bridge API URL</label>
                    <div class="relative flex items-center">
                        <input type="text" readonly value="{{ $config['url'] }}" class="block w-full pr-10 text-sm bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 dark:text-gray-300">
                        <button @click="copy('{{ $config['url'] }}')" class="absolute right-2 p-1 text-gray-400 hover:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Token -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Access Token</label>
                    <div class="relative flex items-center">
                        <input type="password" readonly value="{{ $config['token'] }}" class="block w-full pr-10 text-sm bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 dark:text-gray-300">
                        <button @click="copy('{{ $config['token'] }}')" class="absolute right-2 p-1 text-gray-400 hover:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                        </button>
                    </div>
                    <p class="mt-1 text-[10px] text-gray-400">Copy and paste this token into the desktop app settings.</p>
                </div>
            </div>

            <div class="mt-6 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-2xl border border-amber-100 dark:border-amber-900/30">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <p class="text-xs text-amber-700 dark:text-amber-400">
                        Never share your access token with anyone. It provides full access to your Sshelf vault.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
