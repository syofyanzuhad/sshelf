            <section class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-32 border-t border-gray-200 dark:border-gray-800">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-pink-50 dark:bg-pink-500/10 border border-pink-100 dark:border-pink-500/20 mb-4">
                        <svg class="w-3 h-3 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        <span class="text-[10px] font-bold text-pink-600 dark:text-pink-400 uppercase tracking-widest">Our Supporters</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Community Sponsored</h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">Sshelf is an open-source project powered by the community. Huge thanks to our amazing sponsors!</p>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition duration-500">
                    <!-- Placeholder Logos with better styling -->
                    @foreach(range(1, 4) as $i)
                        <div class="h-8 md:h-10 w-24 md:w-32 bg-gray-200 dark:bg-gray-800 rounded-lg flex items-center justify-center font-black text-gray-400 dark:text-gray-600 text-xs tracking-tighter italic">SPONSOR {{ $i }}</div>
                    @endforeach
                </div>

                <div class="mt-20 text-center">
                    <a href="https://github.com/sponsors/syofyanzuhad" target="_blank" class="inline-flex items-center space-x-3 px-8 py-4 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800 rounded-2xl font-bold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-900 shadow-xl shadow-gray-200/50 dark:shadow-none transition transform hover:-translate-y-1 active:scale-95">
                        <svg class="w-5 h-5 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        <span>Become a Sponsor</span>
                    </a>
                </div>
            </section>
