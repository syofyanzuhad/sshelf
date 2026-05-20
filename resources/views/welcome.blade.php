<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sshelf') }} - Secure SSH Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100">
        <div class="relative min-h-screen">
            <!-- Background Decoration -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                <div class="absolute -top-[30%] -left-[10%] w-[70%] h-[70%] bg-indigo-500/10 blur-[120px] rounded-full"></div>
                <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] bg-blue-500/10 blur-[120px] rounded-full"></div>
            </div>

            <!-- Navigation -->
            <nav class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">{{ config('app.name', 'Sshelf') }}</span>
                </div>

                <div class="flex items-center space-x-4">
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

            <!-- Hero Section -->
            <main class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 sm:pt-24 sm:pb-32 text-center">
                <h1 class="text-5xl sm:text-7xl font-extrabold tracking-tight mb-8">
                    Your SSH Keys, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-blue-400">Finally Organized.</span>
                </h1>
                <p class="max-w-2xl mx-auto text-lg sm:text-xl text-gray-600 dark:text-gray-400 mb-10 leading-relaxed">
                    Sshelf is the secure home for your server credentials. Manage multiple environments, audit connections, and access a real-time terminal directly from your browser.
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-indigo-500/20 transition transform hover:-translate-y-1">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-indigo-500/20 transition transform hover:-translate-y-1">
                            Start for Free
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-8 py-4 rounded-xl font-bold text-lg transition hover:bg-gray-50 dark:hover:bg-gray-800">
                            Log in to Account
                        </a>
                    @endauth
                </div>

                <!-- Preview Mockup (Terminal) -->
                <div class="mt-20 max-w-5xl mx-auto bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                    <div class="bg-gray-800 px-4 py-2 flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-xs text-gray-500 font-mono ml-4">ssh-terminal ~ sshelf</span>
                    </div>
                    <div class="p-6 font-mono text-left text-sm sm:text-base space-y-2">
                        <div class="flex space-x-2">
                            <span class="text-green-400">$</span>
                            <span class="text-white">sshelf connect production-api</span>
                        </div>
                        <div class="text-gray-500">Connecting to 192.168.1.45...</div>
                        <div class="text-gray-500">Welcome to Ubuntu 24.04 LTS (GNU/Linux 6.8.0-31-generic x86_64)</div>
                        <div class="flex space-x-2">
                            <span class="text-green-400">root@prod-api:~#</span>
                            <span class="text-white animate-pulse">|</span>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Features Section -->
            <section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-t border-gray-200 dark:border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-indigo-50 dark:bg-indigo-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-indigo-600 transition">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Encrypted Vault</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Credentials are encrypted at rest using industry-standard AES-256-GCM. Your secrets never leave the server unencrypted.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-blue-50 dark:bg-blue-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-blue-600 transition">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Web Terminal</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">A full-featured xterm.js terminal in your browser. Perform maintenance or emergency fixes from any device, anywhere.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-purple-50 dark:bg-purple-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-purple-600 transition">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Audit Trails</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Every connection is logged. Track session start times, durations, IP addresses, and user agents for complete transparency.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-green-50 dark:bg-green-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-green-600 transition">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Smart Folders</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Organize hundreds of servers into logical groups and tags. Find what you need in seconds with powerful real-time search.</p>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center text-sm text-gray-500 border-t border-gray-200 dark:border-gray-800">
                <p>&copy; {{ date('Y') }} Sshelf. Securely self-hosted for maximum privacy.</p>
            </footer>
        </div>
    </body>
</html>
