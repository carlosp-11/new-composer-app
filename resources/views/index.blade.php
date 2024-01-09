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
        <div class="container-fluid">            
            <div class="row pt-5">
                <div  class="col"> 
                    <h1 class="text-center text-secondary"> Productos </h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row pt-3">
                <div  class="col"> 
                    <div class="table responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Almacenes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $row)
                                    <tr> 
                                        <td> {{ $row->nombre }} </td>
                                        <td> {{ $row->precio }} </td>
                                        <td> 
                                            {{ $categorias->find($row->categoria)->categoria }}
                                        </td>
                                        <td> {{ $row->observaciones }} </td>
                                        <td>
                                            @php
                                                $almacenesIds = $productosAlmacenes->where('id_producto', $row->id)->pluck('id_almacenes');
                                            @endphp
                                            @foreach ($almacenesIds as $item)
                                            @php
                                                $almacen = $almacenes->find($item);
                                            @endphp
                                            @if ($almacen)
                                                {{ $almacen->nombre }}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td> <a href="{{ url('formularios/'. $row->id) }}" class="btn btn-warning">Editar</a> </td>
                                        <td>
                                            <form method="POST" action= "{{url('formularios/'. $row->id)}}">
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
            <a href="{{ url('/formulario') }}" class="btn btn-success"> Crear nuevo Producto </a>
            </div>      
        </div>
    </body>
</html>
