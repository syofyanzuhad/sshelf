    <h2 class="text-3xl font-extrabold mb-8 text-center">Deploy in Seconds</h2>
    <div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-800" x-data="{ copied: false }">
        <div class="bg-gray-800 px-4 py-3 flex justify-between items-center">
            <span class="text-xs text-gray-400 font-mono">docker-compose.yml</span>
            <button @click="navigator.clipboard.writeText('docker run -d --name sshelf ...'); copied = true; setTimeout(() => copied = false, 2000)" class="text-xs text-gray-400 hover:text-white transition">
                <span x-text="copied ? 'Copied!' : 'Copy to Clipboard'"></span>
            </button>
        </div>
        <div class="p-6 font-mono text-sm overflow-x-auto">
            <pre class="text-indigo-300"><code>docker run -d   --name sshelf   -p 8080:80   sshelf/sshelf:latest</code></pre>
        </div>
    </div>
</section>
