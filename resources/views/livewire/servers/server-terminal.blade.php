<div class="py-4 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div class="flex items-center space-x-4">
                    <button wire:click="disconnect" class="text-gray-400 hover:text-white shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                    <h2 class="text-lg sm:text-xl font-semibold text-white truncate">
                        {{ $server->name }} <span class="hidden sm:inline text-sm font-normal text-gray-500">({{ $server->username }}@ {{ $server->host }})</span>
                    </h2>
                </div>
                <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                    <span class="sm:hidden text-xs text-gray-500 truncate mr-auto">{{ $server->host }}</span>
                    <div id="status" class="text-sm text-green-500 shrink-0">Connected</div>
                </div>
            </div>

            <div id="terminal" class="h-[70vh] sm:h-[600px] bg-black p-2" wire:ignore></div>
        </div>
    </div>
...
    @script
    <script>
        const term = new window.Terminal({
            cursorBlink: true,
            theme: {
                background: '#1a1a1a',
                foreground: '#ffffff'
            },
            fontFamily: 'monospace',
            fontSize: 14
        });
        
        const fitAddon = new window.FitAddon();
        term.loadAddon(fitAddon);
        
        term.open(document.getElementById('terminal'));
        fitAddon.fit();
        
        term.onData(data => {
            $wire.sendInput(data);
        });

        // Listen for output from Reverb
        window.Echo.private(`server.{{ $server->id }}`)
            .listen('TerminalOutput', (e) => {
                term.write(e.output);
            });

        window.addEventListener('resize', () => fitAddon.fit());
        
        // Heartbeat to keep worker alive
        setInterval(() => {
            $wire.heartbeat();
        }, 10000);

        term.writeln('Connecting to session...');
    </script>
    @endscript
</div>
