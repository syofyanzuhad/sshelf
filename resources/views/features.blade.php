<x-marketing-layout 
    title="Features" 
    description="Explore the technical depth of Sshelf. From AES-256 encryption to real-time Reverb-powered terminals, learn how we keep your servers secure and accessible."
>
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

            <!-- Real-time Health Metrics -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-200 dark:border-gray-800 shadow-inner grid grid-cols-3 gap-4 text-center">
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                        <div class="text-xs text-gray-500 mb-2 uppercase tracking-wider font-semibold">CPU</div>
                        <div class="text-2xl font-mono text-indigo-600 dark:text-indigo-400">12.4%</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                        <div class="text-xs text-gray-500 mb-2 uppercase tracking-wider font-semibold">Memory</div>
                        <div class="text-2xl font-mono text-indigo-600 dark:text-indigo-400">45.8%</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                        <div class="text-xs text-gray-500 mb-2 uppercase tracking-wider font-semibold">Disk</div>
                        <div class="text-2xl font-mono text-indigo-600 dark:text-indigo-400">72.0%</div>
                    </div>
                    <div class="col-span-3 mt-2 text-xs text-green-500 font-mono flex items-center justify-center space-x-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <span>Live Reverb WebSocket Stream</span>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 uppercase tracking-widest mb-6">
                        Monitoring
                    </div>
                    <h2 class="text-3xl font-bold mb-6">Live Health Telemetry</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                        Sshelf doesn't just manage connections; it monitors your server vitals without requiring complex agent installations on your target machines.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3 text-sm">
                            <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span><strong>Agentless Checks</strong>: Utilizes standard SSH commands like `top` and `free` to grab data, leaving a zero-install footprint.</span>
                        </li>
                        <li class="flex items-start space-x-3 text-sm">
                            <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span><strong>Live Dashboard</strong>: Laravel Reverb pushes new metrics to your Livewire dashboard in real-time.</span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- RBAC & API Bridge -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 uppercase tracking-widest mb-6">
                        Access Management
                    </div>
                    <h2 class="text-3xl font-bold mb-6">RBAC & API Bridge</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                        Built for teams and automation. Sshelf implements Role-Based Access Control and secure API tokens so you can safely distribute access and script operations.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3 text-sm">
                            <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.956 11.956 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span><strong>Admin & Viewer Roles</strong>: Restrict team members to read/connect access without allowing them to modify servers or credentials.</span>
                        </li>
                        <li class="flex items-start space-x-3 text-sm">
                            <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.956 11.956 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span><strong>Sanctum API Tokens</strong>: Generate revocable API keys to integrate Sshelf with your external CLI tools or CI/CD pipelines.</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gray-900 rounded-3xl p-6 border border-gray-800 shadow-inner">
                    <pre class="text-xs font-mono text-teal-400 overflow-x-auto">
<span class="text-gray-500"># Use your Sshelf token from the CLI</span>
curl -X POST https://sshelf.app/api/v1/servers/1/execute \
  -H "Authorization: Bearer 1|abcdef..." \
  -H "Content-Type: application/json" \
  -d '{"command": "tail -n 50 /var/log/syslog"}'
                    </pre>
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
</x-marketing-layout>
