            <footer class="relative z-10 w-full border-t border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-16">
                        <div class="col-span-2 lg:col-span-2">
                            <a href="/" class="flex items-center space-x-3 group mb-6">
                                <div class="bg-indigo-600 p-1.5 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                                    </svg>
                                </div>
                                <span class="text-xl font-black tracking-tight text-gray-900 dark:text-white">{{ config('app.name', 'Sshelf') }}</span>
                            </a>
                            <p class="text-gray-500 text-sm max-w-xs leading-relaxed mb-6">
                                The secure, self-hosted vault for your server credentials and real-time terminal access.
                            </p>
                            <div class="flex space-x-4">
                                <a href="https://github.com/syofyanzuhad/sshelf" class="text-gray-400 hover:text-indigo-500 transition">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6">Product</h4>
                            <ul class="space-y-4 text-sm text-gray-500">
                                <li><a href="{{ route('features') }}" class="hover:text-indigo-500 transition">Features</a></li>
                                <li><a href="{{ route('compare') }}" class="hover:text-indigo-500 transition">Compare</a></li>
                                <li><a href="#" class="hover:text-indigo-500 transition">Releases</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6">Resources</h4>
                            <ul class="space-y-4 text-sm text-gray-500">
                                <li><a href="#" class="hover:text-indigo-500 transition">Documentation</a></li>
                                <li><a href="https://github.com/syofyanzuhad/sshelf" class="hover:text-indigo-500 transition">GitHub</a></li>
                                <li><a href="https://ko-fi.com/syofyanzuhad" class="hover:text-indigo-500 transition">Support Us</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6">Legal</h4>
                            <ul class="space-y-4 text-sm text-gray-500">
                                <li><a href="#" class="hover:text-indigo-500 transition">Privacy Policy</a></li>
                                <li><a href="#" class="hover:text-indigo-500 transition">License</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-gray-100 dark:border-gray-800 text-xs text-gray-400">
                        <p class="mb-4 md:mb-0">&copy; {{ date('Y') }} Sshelf. Securely self-hosted for maximum privacy.</p>
                        <p>Created with ❤️ by <a href="https://syofyanzuhad.dev" target="_blank" class="font-bold text-gray-900 dark:text-gray-100 hover:text-indigo-500 transition">Syofyan Zuhad</a></p>
                    </div>
                </div>
            </footer>
