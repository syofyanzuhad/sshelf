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
        
        <x-theme-script />
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-indigo-50 dark:bg-indigo-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-indigo-600 transition">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Encrypted Vault</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Credentials are encrypted at rest using industry-standard AES-256-GCM. Your secrets never leave your server unencrypted.</p>
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

                    <!-- Feature 5 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-orange-50 dark:bg-orange-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-orange-600 transition">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Self-Host Anywhere</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">You own your data. Deploy Sshelf on your own infrastructure, home lab, or private cloud for ultimate privacy and control.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-cyan-50 dark:bg-cyan-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-cyan-600 transition">
                            <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Docker & One-Click</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Deploy in seconds using our Docker image, or use one-click templates for Railway, Coolify, and more.</p>
                    </div>

                    <!-- Feature 7 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-pink-50 dark:bg-pink-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-pink-600 transition">
                            <svg class="w-6 h-6 text-pink-600 dark:text-pink-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Role-Based Access</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Create Admins to manage infrastructure or Viewers who can only connect to servers. Perfect for team collaboration.</p>
                    </div>

                    <!-- Feature 8 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-yellow-50 dark:bg-yellow-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-yellow-600 transition">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Live Health Metrics</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Background jobs periodically poll your servers and stream real-time CPU, Memory, and Disk usage straight to your dashboard.</p>
                    </div>

                    <!-- Feature 9 -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500 transition group">
                        <div class="bg-teal-50 dark:bg-teal-500/10 p-3 rounded-xl w-fit mb-4 group-hover:bg-teal-600 transition">
                            <svg class="w-6 h-6 text-teal-600 dark:text-teal-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">CLI Bridge API</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Generate Sanctum API tokens and securely retrieve credentials or execute programmatic commands from your local CLI.</p>
                    </div>
                </div>
            </section>

            <!-- Sponsors Section -->
            <section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-gray-200 dark:border-gray-800">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold mb-4">Supported by</h2>
                    <p class="text-gray-600 dark:text-gray-400">Sshelf is an open-source project. Huge thanks to our sponsors!</p>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-12 opacity-70">
                    <!-- Example Sponsor Logos -->
                    <div class="h-12 w-32 bg-gray-300 dark:bg-gray-800 rounded animate-pulse"></div>
                    <div class="h-12 w-32 bg-gray-300 dark:bg-gray-800 rounded animate-pulse"></div>
                    <div class="h-12 w-32 bg-gray-300 dark:bg-gray-800 rounded animate-pulse"></div>
                </div>
                <div class="mt-12 text-center">
                    <a href="https://github.com/sponsors/syofyanzuhad" target="_blank" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                        Become a Sponsor
                    </a>
                </div>
            </section>

            <!-- Footer -->
            <footer class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center text-sm text-gray-500 border-t border-gray-200 dark:border-gray-800">
                <p class="mb-2">Created with ❤️ by <a href="https://syofyanzuhad.dev" target="_blank" class="font-bold text-gray-900 dark:text-gray-100 hover:text-indigo-500 transition">Syofyan Zuhad</a></p>
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="hover:text-pink-500 transition font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Buy me a coffee
                    </a>
                </div>
                <p>&copy; {{ date('Y') }} Sshelf. Securely self-hosted for maximum privacy.</p>
            </footer>
        </div>
    </body>
</html>
