            <nav class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
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
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="text-[10px] font-bold text-gray-500 dark:text-gray-400 hover:text-pink-500 transition uppercase tracking-[0.2em]">Support</a>
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
