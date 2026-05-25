            <div class="px-4 sm:px-6 lg:px-8 pt-16 pb-24 sm:pt-32 sm:pb-40 text-center">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Public Beta v0.1.0</span>
                </div>

                <h1 class="text-5xl sm:text-8xl font-black tracking-tight mb-8 leading-[1.1]">
                    Your SSH Keys,<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-400">Finally Organized.</span>
                </h1>
                
                <p class="max-w-2xl mx-auto text-lg sm:text-xl text-gray-600 dark:text-gray-400 mb-12 leading-relaxed">
                    Sshelf is the secure home for your server credentials. Manage multiple environments, audit connections, and access a real-time terminal directly from your browser.
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-16">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-500/40 transition transform hover:-translate-y-1 active:scale-95">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-500/40 transition transform hover:-translate-y-1 active:scale-95">
                            Start for Free
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800 px-10 py-4 rounded-2xl font-bold text-lg transition hover:bg-gray-50 dark:hover:bg-gray-900 shadow-xl shadow-gray-200/50 dark:shadow-none">
                            Log in to Account
                        </a>
                    @endauth
                </div>

                @if(config('sshelf.mode') === 'saas')
                    <div class="flex justify-center items-center space-x-4 mb-24">
                        <a href="https://smollaunch.com" target="_blank" rel="noopener" class="dark:hidden opacity-80 hover:opacity-100 transition duration-300">
                            <img src="https://smollaunch.com/badges/featured.svg" alt="Featured on Smol Launch" loading="lazy" width="200" height="48" />
                        </a>
                        <a href="https://smollaunch.com" target="_blank" rel="noopener" class="hidden dark:block opacity-80 hover:opacity-100 transition duration-300">
                            <img src="https://smollaunch.com/badges/featured-dark.svg" alt="Featured on Smol Launch" loading="lazy" width="200" height="48" />
                        </a>
                    </div>
                @endif

                <!-- Preview Mockup (Terminal) -->
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-[2rem] blur-2xl opacity-10 group-hover:opacity-20 transition duration-1000"></div>
                    <div class="relative max-w-5xl mx-auto bg-gray-950 rounded-2xl shadow-2xl overflow-hidden border border-gray-800/50">
                        <div class="bg-gray-900/50 backdrop-blur-xl px-4 py-3 flex items-center justify-between border-b border-gray-800">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/50"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/50"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500/20 border border-green-500/50"></div>
                                <span class="text-[10px] text-gray-500 font-mono ml-4 uppercase tracking-widest">ssh-terminal — production-api</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-[10px] text-green-500 font-mono uppercase tracking-widest">Connected</span>
                            </div>
                        </div>
                        <div class="p-8 font-mono text-left text-sm sm:text-base space-y-3">
                            <div class="flex space-x-3">
                                <span class="text-indigo-500 font-bold">➜</span>
                                <span class="text-gray-400">~</span>
                                <span class="text-white">sshelf connect production-api</span>
                            </div>
                            <div class="text-indigo-400/80">Authenticating with Ed25519 key...</div>
                            <div class="text-indigo-400/80">Connection established.</div>
                            <div class="py-2 text-gray-500">
                                Welcome to Ubuntu 24.04 LTS (GNU/Linux 6.8.0-31-generic x86_64)<br/>
                                Last login: {{ now()->subMinutes(5)->format('D M d H:i:s') }} from 192.168.1.100
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-green-400 font-bold">root@prod-api</span>
                                <span class="text-gray-500">:</span>
                                <span class="text-blue-400">~</span>
                                <span class="text-white font-bold">#</span>
                                <span class="w-2 h-5 bg-indigo-500 animate-pulse"></span>
                            </div>
                        </div>
                    </div>
                </div>
