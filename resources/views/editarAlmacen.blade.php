<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edita un Almacen </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.navbar')
        <div class="container-fluid">
            <div class="text-center">                
                    <h1 class="text-center text-secondary pt-5"> Edita un almacén </h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif                 
            <div class="">
                <form method="POST" class="py-3 px-3" id="formulario" >
                    @csrf
                    @method('PUT')                    
                    <div class="mb-3">
                        <label for="Nombre" class="form-label"> Nombre </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$almacen->nombre}}">
                    </div>                   
                    <button type="submit" class="btn btn-primary mb-4 text-center"> Editar </button>
                    <a href="{{ url('/almacenes') }}" class="btn btn-danger mb-4 text-center"> Cancelar </a>
                </form>
            </div>
        </div>            
    </body>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
</html>
