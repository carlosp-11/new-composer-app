<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>CRUD APP - @yield('title')</title>
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
</html>
