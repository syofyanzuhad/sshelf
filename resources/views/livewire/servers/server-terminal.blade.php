<div class="py-4 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div class="flex items-center space-x-4 w-full sm:w-auto">
                    <button wire:click="disconnect" class="text-gray-400 hover:text-white shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                    <h2 class="text-lg sm:text-xl font-semibold text-white truncate">
                        {{ $server->name }} <span class="hidden sm:inline text-sm font-normal text-gray-500">({{ $server->username }}@ {{ $server->host }})</span>
                    </h2>
                </div>
                <div class="flex items-center space-x-3 w-full sm:w-auto justify-end">
                    @php
                        $commands = auth()->user()->quickCommands()
                            ->where(function($query) {
                                $query->whereNull('server_id')->orWhere('server_id', $this->server->id);
                            })
                            ->orderBy('name')
                            ->get();
                    @endphp

                    @if($commands->count() > 0)
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-1 bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-1.5 rounded-lg text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Quick Commands</span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50 overflow-hidden">
                                @foreach($commands as $cmd)
                                    <button @click="open = false; $wire.runCommand('{{ addslashes($cmd->command) }}')" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white transition">
                                        {{ $cmd->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div id="status" class="text-sm text-yellow-500 shrink-0">Connecting...</div>
                    
                    <div class="flex items-center space-x-2 border-l border-gray-800 pl-3 ml-1">
                        <div id="reverb-dot" class="w-2 h-2 rounded-full bg-yellow-500"></div>
                        <span class="text-[10px] font-bold uppercase tracking-tighter text-gray-600 dark:text-gray-500">Socket</span>
                    </div>
                </div>
            </div>

            <div id="terminal" class="h-[70vh] sm:h-[600px] bg-black p-2" wire:ignore></div>
        </div>
    </div>

    @script
    <script>
        const statusEl = document.getElementById('status');
        const reverbDot = document.getElementById('reverb-dot');
        
        // Listen for Reverb connection changes
        if (window.Echo && window.Echo.connector.pusher) {
            const updateReverbStatus = (state) => {
                reverbDot.classList.remove('bg-green-500', 'bg-red-500', 'bg-yellow-500', 'animate-pulse');
                
                if (state.current === 'connected') {
                    reverbDot.classList.add('bg-green-500');
                } else if (state.current === 'connecting') {
                    reverbDot.classList.add('bg-yellow-500', 'animate-pulse');
                } else {
                    reverbDot.classList.add('bg-red-500');
                }
            };

            window.Echo.connector.pusher.connection.bind('state_change', updateReverbStatus);
            
            // Initial state
            updateReverbStatus({ current: window.Echo.connector.pusher.connection.state });
        }

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
            })
            .listen('TerminalStatusUpdated', (e) => {
                statusEl.innerText = e.status.charAt(0).toUpperCase() + e.status.slice(1);
                
                // Update classes based on status
                statusEl.classList.remove('text-green-500', 'text-red-500', 'text-yellow-500', 'text-gray-500');
                
                if (e.status === 'connecting') {
                    statusEl.classList.add('text-yellow-500');
                    if (e.message) {
                        term.writeln('\x1b[33m→ ' + e.message + '\x1b[0m');
                    }
                } else if (e.status === 'connected') {
                    statusEl.classList.add('text-green-500');
                } else if (e.status === 'failed') {
                    statusEl.classList.add('text-red-500');
                    if (e.message) {
                        term.writeln('\r\n\x1b[31mError: ' + e.message + '\x1b[0m');
                    }
                } else if (e.status === 'disconnected') {
                    statusEl.classList.add('text-gray-500');
                    term.writeln('\r\n\x1b[33mSession disconnected.\x1b[0m');
                } else {
                    statusEl.classList.add('text-yellow-500');
                }
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
