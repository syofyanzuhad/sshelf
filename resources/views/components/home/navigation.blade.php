            <nav class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-2 group">
                    <x-application-logo class="w-10 h-10 group-hover:scale-105 transition-transform" />
                    <div class="flex items-baseline space-x-1">
                        <span class="text-2xl font-bold tracking-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ config('app.name', 'Sshelf') }}</span>
                        <span class="px-1.5 py-0.5 text-[10px] font-bold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded uppercase tracking-wider">Beta</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center space-x-8 ml-10">
                    <a href="{{ route('features') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Features</a>
                    <a href="{{ route('compare') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Compare</a>
                    <x-github-link class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition" />
                </div>

                <div class="flex-1 flex justify-end items-center space-x-4">
                    <x-theme-toggle />
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="hidden sm:flex items-center space-x-1 text-sm font-semibold text-pink-600 dark:text-pink-400 hover:text-pink-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Support</span>
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-indigo-500 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-500 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Get Started</a>
                        @endif
                    @endauth
                </div>
            </nav>
