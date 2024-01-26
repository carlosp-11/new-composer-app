
@extends('layouts.main')

@section('title', 'PRODUCTOS')

@section('content')
    <div class="row pt-5 px-0 mx-5">
        <div  class="col"> 
            <h1 class="text-center text-secondary fw-light"> Productos </h1>
        </div>
    </div>   
    <div class="pt-3 mx-5 my-5 px-0">            
        <div class="row justify-content-center mx-0">
            <div class="col-12 col-md-4 ">                
                <div class="row" >
                    <label class="" for="filtro">Filtrar por: </label>         
                    <form method="POST" class="col p-0 m-0 border rounded-start {{ $filtro == 'categoria'? 'bg-primary' : 'bg-secondary' }}" action="{{ url('/productos?filtro=categoria') }}">
                        @csrf 
                            <button type="submit" class="btn w-100 {{ $filtro == 'categoria'? 'text-light': ''}}" aria-pressed="true"> Categoria </button>
                    </form>                            
                    <form method="POST" class="col p-0 m-0 border rounded-end {{ $filtro == 'almacen'? 'bg-primary' : 'bg-secondary' }}" action= "{{url('productos?filtro=almacen')}}">
                        @csrf 
                            <button type="submit" class="btn w-100 {{ $filtro == 'almacen'? 'text-light': ''}}"> Almacen </button>
                    </form>           
                </div>
            </div>          
              
                    <!-- 
                    <div class="col-3 mt-3">                   
                        <form method="POST" action="{{ url('/productos?filtro=categoria') }}">
                             @csrf 
                            <button type="submit" class="">Categoria</button>
                        </form>
                    </div>
                    <div class="col-3  mt-3">
                        <form method="POST" action= "{{url('productos?filtro=almacen')}}">
                            @csrf 
                                <button type="submit" class="btn btn-secondary"> Almacen </button>
                        </form> 
                    </div>
                    -->                

            <div class="col-12 col-md-4">                
                <form action="{{ url('filtrar/productos/'.$filtro) }}" 
                method="POST" class="row" id="formulario">
                    @csrf
                    <div class="col-12 col-md-9">
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
                    <div class="col-12 col-md-3 mt-4 justify-content-center text-center">
                        <button type="submit" class="btn btn-secondary">Buscar</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
           
        



    <div class="pt-3 mx-5 my-5 px-0">
    <div class="row pt-3 px-0">
        <div  class="col px-0 mx-0">            
            <table class="table px-0 mx-0">
                <thead>
                    <tr class="px-0 mx-0">
                        <th scope="col" class="col-2  text-break align-top">Nombre</th>
                        <th scope="col" class="col-1   align-top">Precio</th>
                        <th scope="col" class="col-2  text-break align-top">Almacén</th>
                        <th scope="col" class="col-2  text-break align-topv">Categorías</th>
                        <th scope="col" class="col-3  text-break align-top">Observaciones</th>
                        <th scope="col" class="col-2 "></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $row)
                        <tr class="px-0 mx-0"> 
                            <td class="text-break "> {{ $row->nombre }} </td>
                            <td class="text-break text-end"> 
                                {{ number_format($row->precio, 2, ',', '.') }} € 
                            </td>
                            <td class="text-break "> 
                                {{ $row->almacen ? $almacenes->find($row->almacen)->nombre : 'Sin almacén' }}
                            </td class="text-break ">
                            <td class="text-break ">
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
                            <td class="text-break "> {{ $row->observaciones }} </td>
                            <td class=" text-center">
                                <div class="row"> 
                                    <span class="col-12 col-sm-6">
                                        <a href="{{ url('productos/'.$row->id).'/editar' }}" 
                                        class="btn btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </span>
                                    <span class="col-12 col-sm-6"> 
                                        <form method="POST" action= "{{url('productos/'.$row->id)}}">
                                            @csrf
                                            @method('DELETE')  
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                        </form>
                                    </span>
                                </div>
                            </td>  
                        </tr>                                 
                    @endforeach                               
                </tbody>
            </table>            
        </div>
    </div>
    <div class="pt-5 text-center px-0 mx-0"> 
        <a href="{{ url('/crear-producto') }}" class="btn btn-primary" > Crear nuevo Producto </a>
    </div>

@endsection
