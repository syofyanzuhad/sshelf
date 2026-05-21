<section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="text-center mb-16">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Security by Design</h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Your credentials are protected by multiple layers of encryption and isolation.</p>
    </div>

    <div class="relative">
        <!-- Connection Lines (Hidden on mobile) -->
        <div class="hidden md:block absolute top-1/2 left-1/4 right-1/4 h-0.5 bg-gradient-to-r from-transparent via-gray-200 dark:via-gray-800 to-transparent -translate-y-1/2 -z-10"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            <!-- Source: Your Server -->
            <div class="relative p-8 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none text-center transform hover:-translate-y-1 transition">
                <div class="w-16 h-16 mx-auto mb-6 bg-indigo-50 dark:bg-indigo-500/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Your Browser</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Secure WebSocket connection (WSS) using TLS 1.3 for real-time terminal access.</p>
            </div>

            <!-- Central: Sshelf Vault -->
            <div class="relative p-8 bg-white dark:bg-gray-900 rounded-3xl border-2 border-indigo-500 shadow-2xl shadow-indigo-500/10 text-center transform hover:-translate-y-1 transition z-10">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-indigo-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Secure Hub</div>
                <div class="w-16 h-16 mx-auto mb-6 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/40">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Sshelf Vault</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">AES-256-GCM encryption at rest. Master key is never stored in the database.</p>
            </div>

            <!-- Destination: Target Server -->
            <div class="relative p-8 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none text-center transform hover:-translate-y-1 transition">
                <div class="w-16 h-16 mx-auto mb-6 bg-blue-50 dark:bg-blue-500/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Target Server</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Direct SSH connection using Ed25519 keys or encrypted passwords.</p>
            </div>
        </div>
    </div>
</section>
