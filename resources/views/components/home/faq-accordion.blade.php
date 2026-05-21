<section class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24" x-data="{ active: null }">
    <div class="text-center mb-16">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Frequently Asked Questions</h2>
        <p class="text-gray-600 dark:text-gray-400">Everything you need to know about Sshelf.</p>
    </div>

    <div class="space-y-4">
        @php
            $faqs = [
                [
                    'q' => 'Is Sshelf really free?',
                    'a' => 'Yes! Sshelf is open-source and free to self-host. You can use it for personal or commercial projects without any license fees.'
                ],
                [
                    'q' => 'How secure is the credential storage?',
                    'a' => 'Extremely. We use AES-256-GCM encryption. The encryption key is derived from your unique APP_KEY. Even if your database is compromised, your credentials remain encrypted.'
                ],
                [
                    'q' => 'Can I use it with my existing SSH keys?',
                    'a' => 'Absolutely. You can import your existing private keys or generate new Ed25519 keys directly within Sshelf.'
                ],
                [
                    'q' => 'What happens if I lose my APP_KEY?',
                    'a' => 'Your APP_KEY is the master key for all encryption. If you lose it, you will lose access to all stored passwords and private keys. We recommend backing it up securely.'
                ],
                [
                    'q' => 'Does Sshelf support 2FA?',
                    'a' => 'Yes, Sshelf integrates with standard Laravel authentication, supporting Email verification and 2FA via community packages or custom implementation.'
                ]
            ];
        @endphp

        @foreach($faqs as $idx => $item)
            <div class="group border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden bg-white dark:bg-gray-900 transition hover:border-indigo-500/30">
                <button 
                    @click="active = active === {{ $idx }} ? null : {{ $idx }}" 
                    class="w-full text-left p-6 flex justify-between items-center group-hover:bg-gray-50 dark:group-hover:bg-gray-800/50 transition"
                >
                    <span class="font-bold text-gray-900 dark:text-white">{{ $item['q'] }}</span>
                    <svg 
                        class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                        :class="active === {{ $idx }} ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div 
                    x-show="active === {{ $idx }}" 
                    x-collapse
                    class="p-6 pt-0 text-gray-600 dark:text-gray-400 text-sm leading-relaxed"
                >
                    {{ $item['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>
