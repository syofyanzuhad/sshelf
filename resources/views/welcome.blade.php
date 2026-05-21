<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sshelf') }} - Secure SSH Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <x-theme-script />
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100">
        <div class="relative min-h-screen">
            <!-- Background Decoration -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                <div class="absolute -top-[30%] -left-[10%] w-[70%] h-[70%] bg-indigo-500/10 blur-[120px] rounded-full"></div>
                <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] bg-blue-500/10 blur-[120px] rounded-full"></div>
            </div>

            <x-home.navigation />
            
            <main class="relative z-10">
                <x-home.hero />
                <x-home.features />
                <x-home.quick-start />
                <x-home.security-diagram />
                <x-home.mini-compare />
                <x-home.faq-accordion />
                <x-home.community-banner />
            </main>

            <x-home.sponsors />
            <x-home.footer />
        </div>
    </body>
</html>
