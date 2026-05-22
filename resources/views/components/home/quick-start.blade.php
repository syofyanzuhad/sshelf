<section class="py-20 px-4 bg-white dark:bg-gray-800 transition-colors">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-900 dark:text-white">Deploy in Seconds</h2>
    <div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-800" x-data="{ 
        command: 'cp .env.example .env && docker compose up -d',
        copied: false 
    }">
        <div class="bg-gray-800 px-4 py-3 flex justify-between items-center">
            <span class="text-xs text-gray-400 font-mono">Terminal</span>
            <button @click="navigator.clipboard.writeText(command); copied = true; setTimeout(() => copied = false, 2000)" class="text-xs text-gray-400 hover:text-white transition focus:outline-none">
                <span x-text="copied ? 'Copied!' : 'Copy to Clipboard'"></span>
            </button>
        </div>
        <div class="p-6 font-mono text-sm overflow-x-auto">
            <div class="space-y-2">
                <p class="text-gray-500 mb-2"># Clone the repo and start the stack</p>
                <pre class="text-indigo-300"><code>git clone https://github.com/syofyanzuhad/sshelf.git && cd sshelf</code></pre>
                <pre class="text-indigo-300"><code>cp .env.example .env</code></pre>
                <pre class="text-indigo-300"><code>docker compose up -d</code></pre>
            </div>
        </div>
    </div>
</section>
