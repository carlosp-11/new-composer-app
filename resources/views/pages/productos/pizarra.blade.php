
@extends('layouts.main')

@section('title', 'PRODUCTOS')

@section('content')
    <div class="pt-5 mt-5 px-0 mx-auto">
        <div class="row ">
            <div class="col">            
                <div class="card mb-3" style="width: 600px;">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body">                                    
                                <div id="filtro" class="row">
                                    <div class="col-2">
                                        <div class="row">
                                        <button id="btnCategoria" type="button"  
                                            onclick="filterRequest('categoria')" 
                                            class="btn col text-secondary " aria-pressed="false"
                                        > 
                                            <i class="fa-solid fa-tags"></i>
                                        </button> 
                                        <button id="btnAlmacen" type="button" 
                                            onclick="filterRequest('almacen')" 
                                            class="btn col text-secondary"
                                        > 
                                            <i class="fa-solid fa-warehouse"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="col-8 justify-content-center text-center align-self-center">
                                        <select class="form-select" id="termino" name="termino">
                                            <option> Selecciona una opción </option>
                                        </select>
                                    </div>  
                                    <div class="col-2 justify-content-center text-center align-self-center">
                                        <button type="submit" class="btn btn-secondary w-100" id="buscarBtn">
                                            Filtrar
                                        </button>
                                    </div>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   

        @foreach ($productos as $row)
            <div class="row ">
                <div class="col">            
                    <div class="card mb-3" style="width: 600px;">
                        <div class="row g-0">
                            <div class="col-md-4 align-self-center text-center">
                                <img src="{{ asset('img/pack.png') }}" class="img-fluid rounded-start" 
                                    alt="Producto"
                                >
                            </div>
                            <div class="col-md-8">
                                <div class="card-body pe-3">
                                    <span class="row justifiy-content-between"> 
                                        <h5 class="card-title col"> {{ $row->nombre }} </h5> 
                                        <h6 class="col text-secondary text-end">
                                            {{ number_format($row->precio, 2, ',', '.') }} €  
                                        </h6> 
                                    </span>
                                    <p class="card-text py-0">
                                        @php
                                            $categoriasIds = $productosCategorias->
                                            where('id_producto', $row->id)->pluck('id_categoria');
                                        @endphp
                                        @forelse ($categoriasIds as $item)
                                            @php
                                                $categoria = $categorias->find($item);
                                            @endphp
                                            @if ($categoria)
                                                {{ $categoria->nombre }}
                                            @endif
                                            @empty
                                            Sin categoría
                                        @endforelse
                                        <br>
                                        {{ $row->almacen }} 
                                        <br>
                                        {{ $row->observaciones }}
                                    </p>
                                    <div class="row justify-content-end">
                                        <a href="{{ url('productos/'.$row->id).'/editar' }}" 
                                            class="btn col-2"
                                        >
                                            <i class="fa-solid fa-pen text-secondary fs-4"></i>
                                        </a>
                                        <form method="POST" action= "{{url('productos/'.$row->id)}}" 
                                            class=" col-2"
                                        >
                                            @csrf
                                            @method('DELETE')  
                                            <button type="button" class="btn" data-bs-toggle="modal" 
                                                data-bs-target="#exampleModal"
                                            >
                                                <i class="fa-solid fa-trash-can text-secondary fs-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="my-5 ">
            <div class="pb-5 text-center px-0 mx-auto">
                <a href="{{ url('/crear-producto') }}" class="rounded-circle" > 
                    <i class="fa-solid fa-circle-plus fs-1"></i> 
                </a>
            </div>
        </div>

        <div class="row">
            <nav class="py-5  mx-auto" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $productos->previousPageUrl() }}">
                            Anterior
                        </a>
                    </li>

                    @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $productos->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $productos->currentPage() == $productos->lastPage() ? 
                        'disabled' : '' }}"
                    >
                        <a class="page-link" href="{{ $productos->nextPageUrl() }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
    

    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    <script>
        var filtroSeleccionado = '';

        function filterRequest(selectFilter) {
            filtroSeleccionado = selectFilter;
            // Obtener los botones específicos por sus identificadores
            var botonCategoria = document.getElementById('btnCategoria');
            var botonAlmacen = document.getElementById('btnAlmacen');

            // Restablecer estilos para ambos botones
            console.log("hola", botonCategoria);
            // Establecer estilos solo para el botón seleccionado
            if (selectFilter === 'categoria') {
                botonCategoria.classList.remove( 'text-secondary');
                botonCategoria.classList.add( 'text-primary');
                botonAlmacen.classList.remove( 'text-primary');
                botonAlmacen.classList.add('text-secondary');
            } else if (selectFilter === 'almacen') {
                botonAlmacen.classList.remove('text-secondary');
                botonAlmacen.classList.add('text-primary');
                botonCategoria.classList.remove( 'text-primary');
                botonCategoria.classList.add( 'text-secondary');
            }    
            console.log("chao", botonCategoria);
            // Obtén el elemento select por su ID (puedes ajustar el ID según sea necesario)
            var selectElement = document.getElementById('termino');

            // Limpia las opciones existentes en el select
            selectElement.innerHTML = '';

            // Crea nuevas opciones según el valor de selectFilter
            if (selectFilter === 'categoria') {
                var sinCategoriaOption = document.createElement('option');
                sinCategoriaOption.value = 'null';
                sinCategoriaOption.text = 'Sin categoría';
                selectElement.add(sinCategoriaOption);

                // Si es 'categoria', crea opciones para las categorías
                @foreach ($categorias as $categoria)
                    var option = document.createElement('option');
                    option.value = '{{ $categoria->id }}';
                    option.text = '{{ $categoria->nombre }}';
                    selectElement.add(option);
                @endforeach
            } else if (selectFilter === 'almacen') {
                var sinAlmacenOption = document.createElement('option');
            sinAlmacenOption.value = 'null';
            sinAlmacenOption.text = 'Sin almacén';
            selectElement.add(sinAlmacenOption);
                // Si es 'almacen', crea opciones para los almacenes
                @foreach ($almacenes as $almacen)
                    var option = document.createElement('option');
                    option.value = '{{ $almacen->id }}';
                    option.text = '{{ $almacen->nombre }}';
                    selectElement.add(option);
                @endforeach
            }

        }

        $(document).ready(function () {
                $("#buscarBtn").on("click", function () {
                    var selectedTerm = $("#termino").val();
                    filterProducts(selectedTerm);
                });

            function filterProducts(term) {
                $.ajax({
                url: '{{ url("/productos") }}',
                type: 'POST',
                data: { 
                    filtro: filtroSeleccionado,
                    termino: term,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Actualiza la página o maneja la respuesta según tus necesidades
                    console.log('ajax completo')
                    console.log(response);
                    $('#lista-productos').html(response.productosHtml);
                    //$('#lista-productos').html(response);
                    //location.reload();
                },
                error: function(error) {
                    console.log(error);
                    // Manejar errores si es necesario
                }
            });
        
            }
            });
    </script>
@endsection
