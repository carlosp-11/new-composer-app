@extends('layouts.main')

@section('title', 'AREA PERSONAL')

@section('content')
    <div class="mt-5 px-0 mx-0">  
        <div class="row m-0 p-0 g-5 ">
            <div class="col">
                <div class="card mx-auto animated fadeInUp bg-light shadow" style="width:20rem">
                    <a class="bg-secondary bg-opacity-50 text-center rounded-top border border-light" 
                        href="#"
                    > 
                        <img src="{{ asset('img/pack.png') }}" class="img-fluid rounded-start" 
                            alt="Producto" style="width: 15rem;" 
                        >
                    </a>
                    <div class="card-body">
                        <span class="row justifiy-content-between"> 
                            <h5 class="card-title col"> {{ $producto->nombre }} </h5> 
                            <h6 class="col text-secondary text-end">
                                {{ number_format($producto->precio, 2, ',', '.') }} €  
                            </h6> 
                        </span>
                        <p class="card-text py-0">
                            @php
                                $categoriasIds = $productosCategorias->
                                where('id_producto', $producto->id)->pluck('id_categoria');
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
                                @php
                                    $almacenSelecionado = $almacenes->find($producto->almacen);
                                @endphp
                                @if ($almacenSelecionado)
                                    {{$almacenSelecionado->nombre}}
                                @else
                                Sin almacén
                                @endif
                            <br>
                            {{ $producto->observaciones }}
                        </p>
                        <div class="row justify-content-end">
                            <a href="{{ url('productos/'.$producto->id).'/editar' }}" 
                                class="btn col-6"
                            >
                                <i class="fa-solid fa-pen text-secondary fs-4"></i>
                            </a>
                            <div class="col-6 text-center">
                                <button type="button" class="btn" data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal"
                                >
                                    <i class="fa-solid fa-trash-can text-secondary fs-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="exampleModal" tabindex="-1" 
            aria-labelledby="exampleModalLabel" aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title"> ¿Seguro que deseas borrar? </h5>
                        <button type="button" class="btn-close" 
                            data-bs-dismiss="modal" aria-label="Close"
                        >
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class=""> 
                            Este cambio no podrá deshacerse
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-gradient" 
                            data-bs-dismiss="modal"
                        >
                            Cancelar
                        </button>
                        <form method="POST" action= "{{url('productos/'.$producto->id)}}">
                        @csrf
                        @method('DELETE') 
                            <button type="submit" class="btn btn-danger bg-gradient">
                                Borrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   

    <div class="row m-0 p-0 g-5 ">
        <div class="col">
            <div class="card mx-auto animated fadeInUp bg-light shadow" style="width:20rem">
                <div class="card-header">
                    <h5>Estado del producto: {{ $status->last()->status }}</h5>
                </div>
                <div class="card-body">
                    @php
                        $contador = 1;
                    @endphp
                    @foreach($status as $estado)
                    <div class="row align-items-center pb-2">
                        <div class="col-2 align-items-center">
                        <button type="button" class="btn btn-sm btn-primary rounded-pill align-self-center" 
                            style="width: 2rem; height:2rem;"
                        >
                            {{ $contador }}
                        </button>
                        </div>
                        <div class="col-10">
                            <p class="card-text">
                                <span class="fs-6">{{ $estado->descripcion }}</span> <br/>
                                <span class="d-flex justify-content-between "> 
                                    <span style="font-size: 0.7rem"> {{ $estado->status }} </span> 
                                    <span style="font-size: 0.7rem"> {{ \Carbon\Carbon::parse($estado->created_at)->format('d-m-Y') }} </span> 
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $contador++;
                    @endphp     
                    @endforeach
                    <form id="update-form" action="{{ url('productos/'. $producto->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_producto" value="{{ $producto->id }}">
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status">
                                <option value="en transito">En tránsito</option>
                                <option value="con incidencia">Con incidencia</option>
                                <option value="despachado">Despachado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                    </form>
                    @if($status->last()->status != 'despachado')
                    <div class="row align-items-center">
                        <div class="col-2 align-items-center">
                        <button id="update-button" type="button" class="btn btn-sm btn-secondary rounded-pill align-self-center" 
                            style="width: 2rem; height:2rem;"
                        >
                            {{ $contador }}
                        </button>
                        </div>
                        <div class="col-10">
                            <p class="card-text">
                                <span class="fs-6">Actualizar estado</span> <br/>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
   

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#update-button').click(function() {
            $('#update-button').hide();
            $('#update-form').show();
            });
        });
    </script>
@endsection

