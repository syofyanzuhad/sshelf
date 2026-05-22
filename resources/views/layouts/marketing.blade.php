<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $title = isset($title) ? $title . ' - ' . config('app.name', 'Sshelf') : config('app.name', 'Sshelf') . ' - Secure SSH Management';
        $description = $description ?? 'The secure, self-hosted vault for your server credentials and real-time terminal access. Manage your infrastructure with ease and privacy.';
        $keywords = $keywords ?? 'ssh, server management, self-hosted, security, terminal, web-based ssh, laravel, reverb, opensource';
        $canonical = $canonical ?? url()->current();
    @endphp

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="author" content="Syofyan Zuhad">
    <link rel="canonical" href="{{ $canonical }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('og-image.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $canonical }}">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ asset('og-image.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <x-theme-script />
</head>
<body class="antialiased font-sans bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
    <div class="relative min-h-screen flex flex-col">
        <!-- Background Decoration -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="absolute -top-[30%] -left-[10%] w-[70%] h-[70%] bg-indigo-500/10 blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] bg-blue-500/10 blur-[120px] rounded-full"></div>
        </div>

        <x-home.navigation />
        
        <main class="relative z-10 flex-grow">
            <div class="max-w-5xl mx-auto">
                {{ $slot }}
            </div>
        </main>

        <x-home.footer />
    </div>

    <x-home.support-modal />

    @livewireScripts
</body>
</html>
