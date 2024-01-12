<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crea un producto</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.navbar')
        <div class="container-fluid">
            <div class="text-center">
                <h1 class="text-center text-secondary pt-5">Crea un producto</h1>
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
                <form action="/nueva-categoria" method="POST" class="py-3 px-3" id="formulario">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <button type="submit" class="btn btn-primary mb-4 text-center">Crear</button>
                    <a href="{{ url('/lista-categorias') }}" class="btn btn-danger mb-4 text-center">Cancelar</a>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>

    <script>
        $(document).ready(function () {
            $('#formulario').submit(function (e) {
                // Verificar que ningún campo se envíe vacío
                if (!$('#nombre').val() || !$('#precio').val() || !$('#categoria').val() || !$('input[name="mercadona"]:checked').length && !$('input[name="alteza"]:checked').length && !$('input[name="lidl"]:checked').length) {
                 // alert('Todos los campos deben estar completos.');
                 // e.preventDefault();
                }

                // Verificar que el nombre tenga al menos 3 caracteres
                if ($('#nombre').val().length < 3) {
                 // alert('El nombre debe tener al menos 3 caracteres.');
                 // e.preventDefault(); 
                }

                // Verificar que el nombre tenga al menos 3 caracteres
                if ($('#nombre').val().length > 150) {
                  // alert('El nombre debe tener menos de 150 caracteres.');
                  // e.preventDefault(); 
                }
            });
        });
    </script>
</html>