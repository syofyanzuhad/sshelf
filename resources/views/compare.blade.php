<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sshelf vs. Alternatives - Why Sshelf?</title>

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
                <div class="absolute top-[10%] right-[5%] w-[50%] h-[50%] bg-indigo-500/5 blur-[120px] rounded-full"></div>
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
                    <a href="{{ route('compare') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">Compare</a>
                    <x-github-link class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition" />
                </div>

                <div class="flex-1 flex justify-end items-center space-x-4">
                    <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="hidden sm:flex items-center space-x-1 text-sm font-semibold text-pink-600 dark:text-pink-400 hover:text-pink-500 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Support</span>
                    </a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-500 transition">Log in</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Get Started</a>
                </div>
            </nav>

            <main class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
                <div class="text-center mb-16">
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">Choose a <span class="text-indigo-500">Better Way</span> to SSH</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Stop juggling desktop apps and messy config files. Sshelf brings your infrastructure into a unified, secure, and accessible platform.
                    </p>
                </div>

                <!-- Comparison Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-800">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <th class="p-6 text-sm font-bold uppercase text-gray-500 tracking-wider">Feature</th>
                                <th class="p-6 text-sm font-bold uppercase text-indigo-600 tracking-wider bg-indigo-50/30 dark:bg-indigo-900/10">Sshelf</th>
                                <th class="p-6 text-sm font-bold uppercase text-gray-500 tracking-wider">Desktop Clients</th>
                                <th class="p-6 text-sm font-bold uppercase text-gray-500 tracking-wider">Raw Config</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td class="p-6 font-medium">Access Anywhere</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Yes</span> (Browser)
                                </td>
                                <td class="p-6 text-gray-500">Device Bound</td>
                                <td class="p-6 text-gray-500">Device Bound</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">Security Audit Logs</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Yes</span> (Detailed)
                                </td>
                                <td class="p-6 text-gray-500">Local Only</td>
                                <td class="p-6 text-gray-500">None</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">At-Rest Encryption</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">AES-256-GCM</span>
                                </td>
                                <td class="p-6 text-gray-500">Varied</td>
                                <td class="p-6 text-red-500">Plaintext Keys</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">Group Management</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Smart Tags</span>
                                </td>
                                <td class="p-6 text-gray-500">Basic Folders</td>
                                <td class="p-6 text-gray-500">Manual Sorting</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">Self-Hosted Control</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">100%</span>
                                </td>
                                <td class="p-6 text-gray-500">Proprietary</td>
                                <td class="p-6 text-green-500">Yes</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">Real-time Terminal</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Built-in</span>
                                </td>
                                <td class="p-6 text-green-500">Yes</td>
                                <td class="p-6 text-gray-500">External</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">Open Source</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Yes</span> (MIT)
                                </td>
                                <td class="p-6 text-red-500">Proprietary</td>
                                <td class="p-6 text-green-500">Yes</td>
                            </tr>
                            <tr>
                                <td class="p-6 font-medium">One-Click Deploy</td>
                                <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                                    <span class="text-green-500 font-bold">Yes</span> (Railway/Docker)
                                </td>
                                <td class="p-6 text-gray-500">N/A</td>
                                <td class="p-6 text-gray-500">N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Why Web-Based?</h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Native apps are great until you're on a different machine, a tablet, or an emergency arises while you're away from your workstation. Sshelf gives you a secure, authenticated entry point to your infrastructure from any modern browser.
                        </p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Security First</h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Unlike desktop apps that store keys in obscure local directories, Sshelf uses Laravel's robust encryption layer. Every credential is encrypted at rest, and every connection is audited so you know exactly who accessed what and when.
                        </p>
                    </div>
                </div>

                <div class="mt-20 p-8 rounded-3xl bg-indigo-600 text-white text-center">
                    <h2 class="text-3xl font-bold mb-6">Ready to switch to Sshelf?</h2>
                    <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                        Create Your Free Account
                    </a>
                </div>
            </main>

            <footer class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center text-sm text-gray-500 border-t border-gray-200 dark:border-gray-800">
                <p class="mb-2">Created with ❤️ by <a href="https://syofyanzuhad.dev" target="_blank" class="font-bold text-gray-900 dark:text-gray-100 hover:text-indigo-500 transition">Syofyan Zuhad</a></p>
                <div class="flex justify-center space-x-6 mb-6">
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
