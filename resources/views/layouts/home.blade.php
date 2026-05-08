<!DOCTYPE html>
<html lang="es">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex,nofollow">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('img/cd_icon_mini.png') }}">

        <title>C-DEPOT - @yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="" style="background-image: url('/img/boxes_patern.jpg');
        background-repeat:repeat; background-size: 600px;"
    >
        <div class="container-fluid p-0 m-0 ">
            {{-- Include Alerts --}}
            @include('panels.alerts')       

            {{-- Include Page Content --}}
            @yield('content')   

            {{-- include footer --}}
            @include('panels.footer') 
        </div>
    </body>
    {{-- include default scripts --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/closing-alerts.js') }}"></script>

</html>
