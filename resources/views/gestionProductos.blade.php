<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Lista de Productos </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.navbar')
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
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
            <div class="row pt-5">
                <div  class="col"> 
                    <h1 class="text-center text-secondary"> Productos </h1>
                </div>
            </div>           
            <div class="row pt-3">
                <div  class="col"> 
                    <div class="table responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Almacén</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Categorías</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $row)
                                    <tr> 
                                        <td> {{ $row->nombre }} </td>
                                        <td> {{ $row->precio }} </td>
                                        <td> 
                                            {{ $almacenes->find($row->almacen)->nombre }}    
                                        </td>
                                        <td> {{ $row->observaciones }} </td>
                                        <td>
                                        @php
                                            $categoriasIds = $productosCategorias->where('id_producto', $row->id)->pluck('id_categoria');
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
                                        </td>
                                        <td> <a href="{{ url('productos/'. $row->id) }}" class="btn btn-warning">Editar</a> </td>
                                        <td>
                                            <form method="POST" action= "{{url('productos/'. $row->id)}}">
                                                @csrf
                                                @method('DELETE')  
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form> 
                                        </td>  
                                    </tr>                                 
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="pt-5 text-center"> 
                <a href="{{ url('/nuevo-producto') }}" class="btn btn-success" > Crear nuevo Producto </a>
            </div>      
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
</html>
