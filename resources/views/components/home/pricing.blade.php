<section id="pricing" class="py-24 bg-gray-50 dark:bg-gray-900/50 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">Pilih Paket Sesuai Kebutuhan Anda</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Harga terjangkau untuk pengelolaan infrastruktur yang lebih aman dan profesional.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Starter Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gratis</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Cocok untuk penggunaan pribadi & hobi.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    Rp 0 <span class="text-lg font-normal text-gray-500">/selamanya</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        3 Server Terkelola
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        1 SSH Key
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Terminal Web Dasar
                    </li>
                    <li class="flex items-center text-gray-400">
                        <svg class="w-5 h-5 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Monitoring Real-time
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Mulai Sekarang
                </a>
            </div>

            <!-- Pro Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border-2 border-indigo-500 shadow-2xl relative transform md:-translate-y-4">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-indigo-500 text-white text-xs font-bold uppercase tracking-widest px-4 py-1 rounded-full">
                    Terpopuler
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pro</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Untuk profesional dengan banyak server.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    Rp 49.000 <span class="text-lg font-normal text-gray-500">/bulan</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        20 Server Terkelola
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        5 SSH Keys
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Monitoring Real-time
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Akses API Penuh
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-500/25 transition">
                    Pilih Pro
                </a>
            </div>

            <!-- Business Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Bisnis</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Solusi lengkap untuk tim & perusahaan.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    Rp 149.000 <span class="text-lg font-normal text-gray-500">/bulan</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Server Tanpa Batas
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Tim & Kolaborasi (RBAC)
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Riwayat Audit Lengkap
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Dukungan Prioritas 24/7
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-gray-900 dark:bg-gray-700 text-white font-semibold hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>