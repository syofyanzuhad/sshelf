<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-950 min-h-screen selection:bg-indigo-500 selection:text-white flex items-center justify-center relative overflow-hidden">
        <!-- Background Gradients -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-500/20 dark:bg-indigo-600/20 rounded-full blur-[120px] mix-blend-multiply dark:mix-blend-screen opacity-70"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-500/20 dark:bg-purple-600/20 rounded-full blur-[120px] mix-blend-multiply dark:mix-blend-screen opacity-70"></div>
        </div>

        <div class="relative z-10 w-full flex flex-col items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" wire:navigate class="flex flex-col items-center gap-2 group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-2xl shadow-sm ring-1 ring-gray-900/5 dark:ring-white/10 group-hover:scale-105 transition-transform duration-300">
                        <x-application-logo class="w-12 h-12 fill-current text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ config('app.name', 'Sshelf') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/20 dark:border-gray-700/50">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Sshelf') }}. All rights reserved.
            </div>
        </div>
    </body>
</html>
