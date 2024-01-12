<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edita un producto </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.navbar')        
        <div class="container-fluid">
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
            <div class="text-center">                
                    <h1 class="text-center text-secondary pt-5"> Edita un producto </h1>
            </div>                         
            <div class="">
                <form method="POST" class="py-3 px-3" id="formulario" >
                    @csrf
                    @method('PUT')                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label"> Nombre </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label"> Precio </label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="{{$producto->precio}}">
                    </div>
                    <div class="mb-3">
                        <label for="almacen" class="form-label">Almacén</label>
                        <select id="almacen" class="form-select" name="almacen" form="formulario">
                            @foreach ($almacenes as $option)
                                <option value="{{ $option->id }}" {{ $producto->almacen == $option->id ? 'selected' : '' }} >
                                    {{ $option->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Observaciones" class="form-label"> Observaciones </label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" value="{{$producto->observaciones}}">
                    </div>
                    
                        
                    <div class="mb-3">
                        @foreach ($categorias as $categoria)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ $categoria->nombre }}" name="categorias[]" value="{{ $categoria->id }}" {{ $productosCategorias->where('id_producto', $producto->id)->where('id_categoria', $categoria->id)->isNotEmpty() ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $categoria->nombre }}">{{ $categoria->nombre }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mb-4 text-center"> Editar </button>
                    <a href="{{ url('/lista-productos') }}" class="btn btn-danger mb-4 text-center"> Cancelar </a>
                </form>
            </div>
        </div>            
    </body>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
</html>
