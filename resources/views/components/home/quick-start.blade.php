<section class="py-20 px-4 bg-white dark:bg-gray-800 transition-colors">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-900 dark:text-white">Deploy in Seconds</h2>
    <div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-800" x-data="{ 
        command: 'curl -fsSL https://raw.githubusercontent.com/syofyanzuhad/sshelf/main/install.sh | sudo bash',
        copied: false 
    }">
        <div class="bg-gray-800 px-4 py-3 flex justify-between items-center">
            <span class="text-xs text-gray-400 font-mono">One-line Installer</span>
            <button @click="navigator.clipboard.writeText(command); copied = true; setTimeout(() => copied = false, 2000)" class="text-xs text-gray-400 hover:text-white transition focus:outline-none">
                <span x-text="copied ? 'Copied!' : 'Copy to Clipboard'"></span>
            </button>
        </div>
        <div class="p-6 font-mono text-sm overflow-x-auto text-center py-10">
            <div class="inline-block text-left">
                <p class="text-gray-500 mb-4 text-center"># Run this command on your Linux server</p>
                <div class="bg-black/30 p-4 rounded-xl border border-gray-700/50">
                    <pre class="text-indigo-300"><code>curl -fsSL https://raw.githubusercontent.com/syofyanzuhad/sshelf/main/install.sh | sudo bash</code></pre>
                </div>
            </div>
            <p class="mt-8 text-xs text-gray-500">
                Requires <span class="text-gray-400">Docker</span> and <span class="text-gray-400">Docker Compose</span>. 
                <a href="https://github.com/syofyanzuhad/sshelf#manual-installation" class="text-indigo-500 hover:text-indigo-400 underline">Prefer manual installation?</a>
            </p>
        </div>
    </div>
</section>
