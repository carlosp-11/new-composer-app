
@extends('layouts.main')

@section('title', 'PRODUCTOS')

@section('content')

    <div class="pt-5 mt-5 px-0 mx-auto" >
        @include('panels.productFilter')
        @include('panels.productTable', ['productos' => $productos, 'categorias' => $categorias, 'almacenes' => $almacenes, 'productosCategorias' => $productosCategorias])
        
        <div class="my-5">
            <div class="pb-5 text-center px-0 mx-auto">
                <a href="{{ url('/crear-producto') }}" class="rounded-circle" > 
                    <i class="fa-solid fa-circle-plus display-3"></i> 
                </a>
            </div>
        </div>
        
        @include('panels.productPagination')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    <script>
        var filtroSeleccionado = '';

        function filterRequest(selectFilter) {
            filtroSeleccionado = selectFilter;
            // Obtener los botones específicos por sus identificadores
            var botonCategoria = document.getElementById('btnCategoria');
            var botonAlmacen = document.getElementById('btnAlmacen');
            var botonFiltro = document.getElementById('buscarBtn');
            botonFiltro.classList.remove( 'btn-secondary');
            botonFiltro.classList.add('btn-primary');

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
        });
    
        function filterProducts(term) {
          var data = {
            _token: '{{ csrf_token() }}',
            filtro: filtroSeleccionado,
            termino: term,
            page:1,
          };
      
          $.ajax({
            url: '{{ url("/productos") }}',
            type: 'POST',
            data: data,
            success: function(response) {
                //updatePizarra(response.productosHtml);
              console.log('ajax completed');
              console.log(response.productos);
              //console.log(response.productos.data);
              //$('#lista-productos').html(response.productosHtml);
              //$('#lista-productos').html(response);
         /*     var productosHtml = '';
                response.productos.data.forEach(function(producto) {
                    // Aquí construyes el HTML para cada producto utilizando los datos recibidos
                    // y lo agregas a la variable productosHtml
                    productosHtml += '<div class="row">';
                    productosHtml += '<div class="col">';
                    // Aquí puedes agregar el resto del HTML para representar cada producto
                    // Por ejemplo:
                    productosHtml += '<h5>' + producto.nombre + '</h5>';
                    productosHtml += '</div>';
                    productosHtml += '</div>';
                });
                */
                $('#lista-productos').html(response.productosHtml);
                $('#pagination-container').html(response.productosPaginationHtml);
                //$('#pagination-container').html(response.productos);
                //$('#pagination-container').html(response.productosHtml);
            },
            error: function(error) {
              // Handle errors
              console.error(error);
            }
          });
        }    
    </script>
@endsection
