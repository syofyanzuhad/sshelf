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
                <div class="flex items-center space-x-2">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="bg-indigo-600 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight">{{ config('app.name', 'Sshelf') }}</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
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
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="/" class="hover:text-indigo-500 transition">Home</a>
                    <a href="https://github.com/syofyanzuhad/sshelf" class="hover:text-indigo-500 transition">GitHub</a>
                </div>
                <p>&copy; {{ date('Y') }} Sshelf. Built for developers by developers.</p>
            </footer>
        </div>
    </body>
</html>
