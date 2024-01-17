@extends('layouts.main')

@section('title', $modo == 'crear' ? 'CREAR UN PRODUCTO' : 'EDITAR UN PRODUCTO')

@section('content')
    <div class="text-center mx-5">
        <h1 class="text-center text-secondary pt-5">{{  $modo == 'crear' ? 'Crea': 'Edita' }} un producto</h1>
    </div>    
    <div class="mx-5">
        <form action="{{ $modo == 'crear' ? url('/crear-producto') : url('/productos/'.$producto->id).'/editar' }}" 
        method="POST" class="py-3 px-3" id="formulario">
            @csrf
            @if($modo == 'editar')
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre del producto" value="{{ $modo == 'editar' ? $producto->nombre : '' }}">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Escriba el importe" step="0.01" value="{{ $modo == 'editar' ? $producto->precio : '' }}">
            </div>
            <div class="mb-3">
                <label for="almacen" class="form-label">Almacen</label>
                <select id="almacen" class="form-select" name="almacen" form="formulario">
                    @foreach ($almacenes as $option)
                    <option value="{{ $option->id }}" {{ $modo == 'editar' ? $producto->almacen == $option->id ? 'selected' : '' :  '' }}>
                        {{ $option->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Escriba las observaciones" value="{{ $modo == 'editar' ?$producto->observaciones: ''}}">
            </div>
            <div class="mb-3">
                @foreach ($categorias as $categoria)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $categoria->nombre }}" name="categorias[]"  value="{{ $categoria->id }}"
                        @if($modo == 'editar')
                            {{ $productosCategorias->where('id_producto', $producto->id)->where('id_categoria', $categoria->id)->isNotEmpty() ? 'checked' : '' }}
                        @endif
                        >
                        <label class="form-check-label" for="{{ $categoria->nombre }}">{{ $categoria->nombre }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mb-4 text-center">{{$modo == 'crear' ? 'Crear' : 'Editar'}}</button>
            <a href="{{ url('/productos') }}" class="btn btn-danger mb-4 text-center">Cancelar</a>
        </form>
    </div>

    
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

                // Verificar que el nombre tenga al menos 3 caracteresb
                if ($('#nombre').val().length > 150) {
                  // alert('El nombre debe tener menos de 150 caracteres.');
                  // e.preventDefault(); 
                }
            });
        });
    </script>
@endsection