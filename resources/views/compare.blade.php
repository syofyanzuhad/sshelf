<x-marketing-layout 
    title="Compare" 
    description="Compare Sshelf with traditional desktop clients and raw SSH configs. See why developers are switching to a secure, web-based vault for infrastructure management."
>
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
                        <td class="p-6 font-medium">SSH Key Manager</td>
                        <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                            <span class="text-green-500 font-bold">Built-in (Ed25519)</span>
                        </td>
                        <td class="p-6 text-gray-500">Requires Agent</td>
                        <td class="p-6 text-gray-500">Manual Creation</td>
                    </tr>
                    <tr>
                        <td class="p-6 font-medium">Team Access Control (RBAC)</td>
                        <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                            <span class="text-green-500 font-bold">Yes</span> (Admins/Viewers)
                        </td>
                        <td class="p-6 text-gray-500">Paid/Enterprise Only</td>
                        <td class="p-6 text-red-500">None</td>
                    </tr>
                    <tr>
                        <td class="p-6 font-medium">Live Health Telemetry</td>
                        <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                            <span class="text-green-500 font-bold">Yes</span> (Real-time)
                        </td>
                        <td class="p-6 text-red-500">No</td>
                        <td class="p-6 text-gray-500">Requires 3rd Party</td>
                    </tr>
                    <tr>
                        <td class="p-6 font-medium">Programmatic API/CLI Bridge</td>
                        <td class="p-6 bg-indigo-50/30 dark:bg-indigo-900/10">
                            <span class="text-green-500 font-bold">Yes</span> (Sanctum Tokens)
                        </td>
                        <td class="p-6 text-red-500">No</td>
                        <td class="p-6 text-red-500">No</td>
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
            <div>
                <h2 class="text-2xl font-bold mb-4">Built for Teams</h2>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Stop sharing private keys in Slack. Sshelf's Role-Based Access Control (RBAC) allows you to invite Viewers who can securely connect to servers through the browser without ever seeing the underlying passwords or keys.
                </p>
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-4">Automate Everything</h2>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Desktop apps trap your infrastructure. Sshelf provides a secure CLI Bridge API via Sanctum tokens, allowing you to fetch server data or execute commands programmatically from your CI/CD pipelines.
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
</x-marketing-layout>
