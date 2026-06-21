<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/cd_icon_mini.png') }}">
    <title>C-DEPOT — @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-surface text-ink-950 antialiased">
    <header class="px-4 sm:px-6 py-4">
        <x-brand.logo :size="32" />
    </header>

    @include('panels.alerts')

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        @yield('content')
    </main>

    <x-chrome.footer />

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/closing-alerts.js') }}"></script>
    @stack('scripts')
</body>
</html>
