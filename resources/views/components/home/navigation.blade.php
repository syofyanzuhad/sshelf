            <nav class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="bg-indigo-600 p-1.5 rounded-lg shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-black tracking-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ config('app.name', 'Sshelf') }}</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em]">Secure Vault</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('features') }}" class="text-[10px] font-bold {{ request()->routeIs('features') ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-500 dark:text-gray-400' }} hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase tracking-[0.2em]">Features</a>
                    <a href="{{ route('compare') }}" class="text-[10px] font-bold {{ request()->routeIs('compare') ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-500 dark:text-gray-400' }} hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase tracking-[0.2em]">Compare</a>
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="flex items-center space-x-1.5 text-[10px] font-bold text-red-500 hover:text-red-600 transition uppercase tracking-[0.2em]">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span>Support</span>
                    </a>
                </div>

                <div class="flex items-center space-x-5">
                    <div class="hidden lg:flex items-center space-x-5 border-r border-gray-200 dark:border-gray-800 pr-5">
                        <x-github-link class="text-[10px] font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase tracking-[0.2em]" />
                        <x-theme-toggle />
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-xs font-bold text-gray-900 dark:text-white hover:text-indigo-600 transition uppercase tracking-widest">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 transition uppercase tracking-widest">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden md:block bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition shadow-lg shadow-indigo-500/20 active:scale-95">Get Started</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </nav>
