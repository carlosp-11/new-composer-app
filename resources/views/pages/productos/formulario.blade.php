@extends('layouts.main')

@section('title', $modo == 'crear' ? 'CREAR UN PRODUCTO' : 'EDITAR UN PRODUCTO')

@section('content')
<div class="align-self-center mx-auto">
    <div class="card mb-3 px-0 align-self-center mx-5" style="max-width: 600px;">
        <div class="row g-0 mx-0 p-0">
            <div class="card-header">
                <h1 class="text-center text-secondary fw-light"> 
                    {{  $modo == 'crear' ? 'Crea': 'Edita' }} un producto
                </h1>
            </div>
            <div class="card-body">
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
                        <textarea type="text" class="form-control" id="observaciones" rows="2" name="observaciones" placeholder="Escriba las observaciones" >
                            {{ $modo == 'editar' ?$producto->observaciones: ''}}
                        </textarea>
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
                    <div class="card-footer bg-white mb-4 px-0 mx-0">
                        <button type="submit" class="btn btn-primary w-25 text-center">{{$modo == 'crear' ? 'Crear' : 'Editar'}}</button>
                        <a href="{{ url('/productos') }}" class="btn btn-secondary text-center">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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