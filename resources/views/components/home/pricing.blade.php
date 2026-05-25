<section id="pricing" class="py-24 bg-gray-50 dark:bg-gray-900/50 transition-colors" x-data="{ 
    currency: 'IDR',
    t: {
        IDR: {
            title: 'Pilih Paket Sesuai Kebutuhan Anda',
            desc: 'Harga terjangkau untuk pengelolaan infrastruktur yang lebih aman dan profesional.',
            starter: 'Gratis',
            starter_desc: 'Cocok untuk penggunaan pribadi & hobi.',
            pro_desc: 'Untuk profesional dengan banyak server.',
            business: 'Bisnis',
            business_desc: 'Solusi lengkap untuk tim & perusahaan.',
            per_month: '/bulan',
            forever: '/selamanya',
            start_now: 'Mulai Sekarang',
            choose_pro: 'Pilih Pro',
            contact_us: 'Hubungi Kami',
            popular: 'Terpopuler',
            features: {
                servers_3: '3 Server Terkelola',
                keys_1: '1 SSH Key',
                terminal: 'Terminal Web Dasar',
                monitoring: 'Monitoring Real-time',
                servers_20: '20 Server Terkelola',
                keys_5: '5 SSH Keys',
                api: 'Akses API Penuh',
                unlimited_servers: 'Server Tanpa Batas',
                collaboration: 'Tim & Kolaborasi (RBAC)',
                audit: 'Riwayat Audit Lengkap',
                support: 'Dukungan Prioritas 24/7'
            }
        },
        USD: {
            title: 'Choose the Right Plan for You',
            desc: 'Affordable pricing for secure and professional infrastructure management.',
            starter: 'Free',
            starter_desc: 'Perfect for personal use & hobbies.',
            pro_desc: 'For professionals with multiple servers.',
            business: 'Business',
            business_desc: 'Complete solution for teams & companies.',
            per_month: '/month',
            forever: '/forever',
            start_now: 'Start Now',
            choose_pro: 'Choose Pro',
            contact_us: 'Contact Us',
            popular: 'Most Popular',
            features: {
                servers_3: '3 Managed Servers',
                keys_1: '1 SSH Key',
                terminal: 'Basic Web Terminal',
                monitoring: 'Real-time Monitoring',
                servers_20: '20 Managed Servers',
                keys_5: '5 SSH Keys',
                api: 'Full API Access',
                unlimited_servers: 'Unlimited Servers',
                collaboration: 'Team & Collaboration (RBAC)',
                audit: 'Full Audit Logs',
                support: '24/7 Priority Support'
            }
        }
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-4" x-text="t[currency].title">Pilih Paket Sesuai Kebutuhan Anda</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8" x-text="t[currency].desc">Harga terjangkau untuk pengelolaan infrastruktur yang lebih aman dan profesional.</p>
            
            <!-- Currency Toggle -->
            <div class="flex items-center justify-center space-x-4 mb-12">
                <span :class="{ 'text-gray-900 dark:text-white font-bold': currency === 'IDR', 'text-gray-500': currency !== 'IDR' }" class="text-sm transition-colors cursor-pointer" @click="currency = 'IDR'">IDR (Rp)</span>
                <button 
                    @click="currency = currency === 'IDR' ? 'USD' : 'IDR'" 
                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none bg-gray-200 dark:bg-gray-700"
                    role="switch"
                >
                    <span 
                        aria-hidden="true" 
                        :class="currency === 'USD' ? 'translate-x-5' : 'translate-x-0'"
                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                    ></span>
                </button>
                <span :class="{ 'text-gray-900 dark:text-white font-bold': currency === 'USD', 'text-gray-500': currency !== 'USD' }" class="text-sm transition-colors cursor-pointer" @click="currency = 'USD'">USD ($)</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <!-- Starter Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" x-text="t[currency].starter">Gratis</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6" x-text="t[currency].starter_desc">Cocok untuk penggunaan pribadi & hobi.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    <span x-show="currency === 'IDR'">Rp 0</span>
                    <span x-show="currency === 'USD'">$0</span>
                    <span class="text-lg font-normal text-gray-500" x-text="t[currency].forever">/selamanya</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.servers_3">3 Server Terkelola</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.keys_1">1 SSH Key</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.terminal">Terminal Web Dasar</span>
                    </li>
                    <li class="flex items-center text-gray-400">
                        <svg class="w-5 h-5 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span x-text="t[currency].features.monitoring">Monitoring Real-time</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition" x-text="t[currency].start_now">
                    Mulai Sekarang
                </a>
            </div>

            <!-- Pro Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border-2 border-indigo-500 shadow-2xl relative transform md:-translate-y-4">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-indigo-500 text-white text-xs font-bold uppercase tracking-widest px-4 py-1 rounded-full" x-text="t[currency].popular">
                    Terpopuler
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pro</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6" x-text="t[currency].pro_desc">Untuk profesional dengan banyak server.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    <span x-show="currency === 'IDR'">Rp 49.000</span>
                    <span x-show="currency === 'USD'">$4</span>
                    <span class="text-lg font-normal text-gray-500" x-text="t[currency].per_month">/bulan</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.servers_20">20 Server Terkelola</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.keys_5">5 SSH Keys</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.monitoring">Monitoring Real-time</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.api">Akses API Penuh</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-500/25 transition" x-text="t[currency].choose_pro">
                    Pilih Pro
                </a>
            </div>

            <!-- Business Plan -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" x-text="t[currency].business">Bisnis</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6" x-text="t[currency].business_desc">Solusi lengkap untuk tim & perusahaan.</p>
                <div class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                    <span x-show="currency === 'IDR'">Rp 149.000</span>
                    <span x-show="currency === 'USD'">$12</span>
                    <span class="text-lg font-normal text-gray-500" x-text="t[currency].per_month">/bulan</span>
                </div>
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.unlimited_servers">Server Tanpa Batas</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.collaboration">Tim & Kolaborasi (RBAC)</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.audit">Riwayat Audit Lengkap</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span x-text="t[currency].features.support">Dukungan Prioritas 24/7</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 px-6 rounded-xl bg-gray-900 dark:bg-gray-700 text-white font-semibold hover:bg-gray-800 dark:hover:bg-gray-600 transition" x-text="t[currency].contact_us">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>