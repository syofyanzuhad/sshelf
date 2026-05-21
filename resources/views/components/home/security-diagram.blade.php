    <h2 class="text-3xl font-extrabold mb-16 text-center">How It Works & Security</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach(['Your Server' => 'shield', 'Sshelf Vault' => 'lock', 'Web Terminal' => 'terminal'] as $title => $icon)
            <div class="relative p-8 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center">
                     <!-- Icon placeholder -->
                     <span class="text-indigo-600 dark:text-indigo-400">{{ $icon }}</span>
                </div>
                <h3 class="text-lg font-bold mb-2">{{ $title }}</h3>
            </div>
        @endforeach
    </div>
</section>
