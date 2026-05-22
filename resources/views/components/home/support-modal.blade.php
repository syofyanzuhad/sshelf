<div
    x-data="{ open: false }"
    @open-support-modal.window="open = true"
    x-show="open"
    class="fixed inset-0 z-50 overflow-y-auto"
    x-cloak
>
    <!-- Backdrop -->
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false" 
        class="fixed inset-0 bg-gray-950/50 backdrop-blur-sm transition-opacity"
    ></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div 
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-900 px-4 pb-4 pt-5 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-8 border border-gray-100 dark:border-gray-800"
        >
            <!-- Close Button -->
            <div class="absolute right-0 top-0 pr-6 pt-6">
                <button @click="open = false" type="button" class="rounded-full bg-gray-50 dark:bg-gray-800 p-2 text-gray-400 hover:text-gray-500 focus:outline-none transition">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <div class="flex items-center justify-center sm:justify-start space-x-3 mb-6">
                        <div class="bg-pink-100 dark:bg-pink-900/30 p-2.5 rounded-2xl">
                            <svg class="w-6 h-6 text-pink-600 dark:text-pink-400 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black tracking-tight text-gray-900 dark:text-white" id="modal-title">Support Sshelf</h3>
                    </div>
                    
                    <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
                        Sshelf is a labor of love, built to provide a secure and accessible SSH management experience for everyone. Your support helps keep the lights on and the code flowing.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Ko-fi (International) -->
                        <a href="https://ko-fi.com/syofyanzuhad" target="_blank" class="group flex flex-col items-center p-6 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100 dark:border-blue-800/50 hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                            <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-[#29abe2] fill-current" viewBox="0 0 24 24">
                                    <path d="M23.881 8.948c-.773-4.085-4.859-4.593-4.859-4.593H.724c-.304 0-.54.24-.54.542v15.228c0 .303.236.541.54.541h13.914c1.282 0 2.277-.662 2.808-1.42 2.23.084 6.357-1.312 6.44-10.301.002-.132-.001-.25-.005-.365zM17.433 13.9c-.31.864-1.286 1.488-2.316 1.488H3.32V7.12h13.144c.484 0 1.258.17 1.637.755.337.525.378 1.15.352 1.954-.055 1.66-.46 3.197-1.02 4.071zm3.844-3.56c-.053 4.254-2.124 5.234-2.822 5.344.208-.437.385-1.07.51-1.895.204-1.32.222-2.36.195-3.136-.025-1.2-.218-1.924-.492-2.313-.197-.278-.507-.468-.863-.585 0 0 3.018-.112 4.212 1.34.423.51.34 1.58.26 2.245z"/>
                                </svg>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">Ko-fi</span>
                            <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold uppercase tracking-widest mt-1">International</span>
                        </a>

                        <!-- Trakteer (Indonesia) -->
                        <a href="https://trakteer.id/syofyanzuhad" target="_blank" class="group flex flex-col items-center p-6 bg-red-50 dark:bg-red-900/20 rounded-2xl border border-red-100 dark:border-red-800/50 hover:bg-red-100 dark:hover:bg-red-900/40 transition">
                            <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-red-600 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">Trakteer</span>
                            <span class="text-[10px] text-red-600 dark:text-red-400 font-bold uppercase tracking-widest mt-1">Indonesia</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-[10px] text-gray-400 dark:text-gray-500 uppercase tracking-widest font-bold">
                    Thank you for being part of the journey!
                </p>
            </div>
        </div>
    </div>
</div>
