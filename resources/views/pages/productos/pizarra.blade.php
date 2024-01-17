
@extends('layouts.main')

@section('title', 'PRODUCTOS')

@section('content')
    <div class="row pt-5 px-0 mx-5">
        <div  class="col"> 
            <h1 class="text-center text-secondary"> Productos </h1>
        </div>
    </div>   
    @dump($productos);
    <div class="pt-3 mx-5 my-5">
            
            <div class="row justify-content-center">
                <div class="col-4 justify-content-center d-flex mt-4">
                    <label class="me-3 mt-3" for="filtro">Filtrar por: </label>
                    <div class="col-3 mt-3">                   
                        <form method="POST" action="{{ url('/productos?filtro=categoria') }}">
                             @csrf 
                            <button type="submit" class="btn btn-primary">Categoria</button>
                        </form>
                    </div>
                    <div class="col-3 mt-3">
                        <form method="POST" action= "{{url('productos?filtro=almacen')}}">
                            @csrf 
                                <button type="submit" class="btn btn-primary"> Almacen </button>
                        </form> 
                    </div>
                </div>
                <div class="col-4 ">
                    
                    <form action="{{ url('filtrar/productos/'.$filtro) }}" 
                    method="POST" class="py-3 px-3 row" id="formulario">
                        @csrf
                        <div class="col-6">
                        <label for="termino">Término:</label>
                        <select class="form-select" id="termino" name="termino">
                            @if ($filtro ==='')
                                <option> Selecciona un filtro </option>
                            @elseif ($filtro === 'categoria')
                                <option value="null"> Sin categoría </option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            @elseif ($filtro === 'almacen')
                                <option value="null"> Sin almacén </option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        <input type="hidden" name="filtro" value="{{ $filtro }}">
                        </div>
                
                        <div class="col-4 mt-4">
                            <button type="submit" class="btn btn-secondary w-100">Buscar</button>
                        </div>
                    </form>
                    
                </div>
            </div>
           
        </div>



    
    <div class="row pt-3 px-0 mx-5">
        <div  class="col"> 
            <div class="table responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="col-3">Nombre</th>
                            <th scope="col" class="col-1">Precio</th>
                            <th scope="col" class="col-2">Almacén</th>
                            <th scope="col" class="col-2">Observaciones</th>
                            <th scope="col" class="col-2">Categorías</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $row)
                            <tr> 
                                <td> {{ $row->nombre }} </td>
                                <td> {{ number_format($row->precio, 2, ',', '.') }} € </td>
                                <td> 
                                    {{ $row->almacen ? $almacenes->find($row->almacen)->nombre : 'Sin almacén' }}
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
                                <td> <a href="{{ url('productos/'.$row->id).'/editar' }}" class="btn btn-warning">Editar</a> </td>
                                <td>
                                    <form method="POST" action= "{{url('productos/'.$row->id)}}">
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
        <a href="{{ url('/crear-producto') }}" class="btn btn-success" > Crear nuevo Producto </a>
    </div>

@endsection
