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
