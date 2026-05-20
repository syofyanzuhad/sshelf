<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Features - Sshelf Technical Deep Dive</title>

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
                <div class="absolute top-[5%] -left-[10%] w-[60%] h-[60%] bg-indigo-500/5 blur-[120px] rounded-full"></div>
                <div class="absolute bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-blue-500/5 blur-[120px] rounded-full"></div>
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
                    <a href="{{ route('features') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">Features</a>
                    <a href="{{ route('compare') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Compare</a>
                    <a href="https://github.com/syofyanzuhad/sshelf" target="_blank" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">GitHub</a>
                </div>

                <div class="flex-1 flex justify-end items-center space-x-4">
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="hidden sm:flex items-center space-x-1 text-sm font-semibold text-pink-600 dark:text-pink-400 hover:text-pink-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Support</span>
                    </a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-500 transition">Log in</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Get Started</a>
                </div>
            </nav>

            <main class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
                <div class="text-center mb-20">
                    <h1 class="text-5xl font-extrabold tracking-tight mb-6">Built for <span class="text-indigo-500">Security & Speed</span></h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto leading-relaxed">
                        Sshelf isn't just a wrapper. It's a purpose-built platform for modern infrastructure management. Explore the tech that keeps your servers safe and accessible.
                    </p>
                </div>

                <div class="space-y-32">
                    <!-- Security Deep Dive -->
                    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-6">
                                Security First
                            </div>
                            <h2 class="text-3xl font-bold mb-6">The Sshelf Vault Architecture</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                                We use Laravel's native encryption layer to secure every sensitive byte. Unlike desktop clients that store keys in plaintext or easily guessable folders, Sshelf implements a zero-trust storage model on your server.
                            </p>
                            <ul class="space-y-4">
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span><strong>AES-256-GCM Encryption</strong>: Industry standard authenticated encryption for passwords and private keys.</span>
                                </li>
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span><strong>Isolated Environment</strong>: Credentials never leave the application unencrypted except during the actual SSH handshake.</span>
                                </li>
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span><strong>EncryptedNullable Casts</strong>: Custom Eloquent casts handle encryption seamlessly at the model layer.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-8 border border-gray-200 dark:border-gray-800 shadow-inner">
                            <pre class="text-xs font-mono text-indigo-600 dark:text-indigo-400 overflow-x-auto">
// app/Models/Server.php

protected $casts = [
    'password' => EncryptedNullable::class,
    'private_key' => EncryptedNullable::class,
];

// Data is automatically encrypted before 
// hitting the database and decrypted on read.
                            </pre>
                        </div>
                    </section>

                    <!-- Terminal Architecture -->
                    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div class="order-2 lg:order-1 bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                            <div class="bg-gray-800 px-4 py-2 flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="text-xs text-gray-500 font-mono ml-4">Architecture: Reverb + Worker</span>
                            </div>
                            <div class="p-6 font-mono text-xs text-gray-400 space-y-4">
                                <div>[BROWSER] <--> [REVERB WEBSOCKET]</div>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</div>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[SSH WORKER]</div>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</div>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[REMOTE SERVER]</div>
                                <div class="pt-4 text-green-400">// Real-time, low-latency execution</div>
                            </div>
                        </div>
                        <div class="order-1 lg:order-2">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 uppercase tracking-widest mb-6">
                                Live Terminal
                            </div>
                            <h2 class="text-3xl font-bold mb-6">Real-time Stream Engine</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                                Sshelf uses a unique combination of **Laravel Reverb** and background artisan workers to deliver a high-performance terminal experience without blocking your web server.
                            </p>
                            <ul class="space-y-4">
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span><strong>Xterm.js</strong>: The same engine that powers VS Code's terminal, right in your browser.</span>
                                </li>
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span><strong>Reverb WebSockets</strong>: Ultra-fast, bi-directional communication with zero overhead.</span>
                                </li>
                                <li class="flex items-start space-x-3 text-sm">
                                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span><strong>Output Buffering</strong>: Sshelf maintains a 2000-char buffer so you can refresh the page without losing context.</span>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <!-- Audit Trails -->
                    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 uppercase tracking-widest mb-6">
                                Compliance & Transparency
                            </div>
                            <h2 class="text-3xl font-bold mb-6">Unrivaled Audit Trails</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                                In a shared environment, knowing "who connected when" is critical. Sshelf logs every session request and termination, giving you a full paper trail of infrastructure access.
                            </p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white dark:bg-gray-900 p-4 rounded-xl border border-gray-100 dark:border-gray-800">
                                    <div class="text-xs text-gray-500 mb-1">IP Tracking</div>
                                    <div class="text-sm font-bold">Origin Captured</div>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-4 rounded-xl border border-gray-100 dark:border-gray-800">
                                    <div class="text-xs text-gray-500 mb-1">Durations</div>
                                    <div class="text-sm font-bold">Session Timing</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-2 border border-gray-200 dark:border-gray-800">
                            <table class="w-full text-[10px] text-left">
                                <tr class="bg-gray-50 dark:bg-gray-800">
                                    <th class="p-2">Server</th>
                                    <th class="p-2">IP</th>
                                    <th class="p-2">Status</th>
                                </tr>
                                <tr class="border-t border-gray-100 dark:border-gray-800">
                                    <td class="p-2">prod-api-01</td>
                                    <td class="p-2">192.168.1.1</td>
                                    <td class="p-2 text-green-500">Success</td>
                                </tr>
                                <tr class="border-t border-gray-100 dark:border-gray-800">
                                    <td class="p-2">staging-db</td>
                                    <td class="p-2">10.0.0.45</td>
                                    <td class="p-2 text-red-500">Failed</td>
                                </tr>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Call to Action -->
                <div class="mt-32 p-12 rounded-3xl bg-gradient-to-br from-indigo-600 to-blue-600 text-white text-center shadow-2xl shadow-indigo-500/20">
                    <h2 class="text-4xl font-bold mb-6">Ready to secure your shelf?</h2>
                    <p class="text-indigo-100 mb-8 max-w-xl mx-auto">
                        Join developers who trust Sshelf for their emergency fixes, maintenance, and multi-server management.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-white text-indigo-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Get Started Now
                        </a>
                        <a href="https://github.com/syofyanzuhad/sshelf" class="w-full sm:w-auto bg-indigo-500/20 border border-white/20 px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition">
                            View GitHub
                        </a>
                    </div>
                </div>
            </main>

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
                <p>&copy; {{ date('Y') }} Sshelf. Built for developers by developers.</p>
            </footer>
        </div>
    </body>
</html>
