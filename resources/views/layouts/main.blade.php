<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
        <title>CRUD APP - @yield('title')</title>
    </head>
    <body>
        <div class="container-fluid p-0 m-0">
        {{-- Include Navbar --}}
                @include('panels.navbar')
        @if (session('success'))
                <div class="alert alert-success px-0 mx-0">
                    {{ session('success') }}
                </div>
            @endif
        @if ($errors->any())
                <div class="alert alert-danger px-0 mx-0">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger px-0 mx-0">
                    {{ session('error') }}
                </div>
            @endif  
                {{-- Include Page Content --}}
                @yield('content')             
                {{-- include footer --}}
                @include('panels.footer')
                {{-- include default scripts --}}
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</html>
