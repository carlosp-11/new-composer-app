<div id="lista-productos">
    @if(!empty($productos[0]))
        @foreach ($productos as $row)
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
                                        @php
                                            $almacenSelecionado = $almacenes->find($row->almacen);
                                        @endphp
                                        @if ($almacenSelecionado)
                                            {{$almacenSelecionado->nombre}}
                                        @else
                                        Sin almacén
                                        @endif
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
        @endforeach
    @else
        <p class="text-center fs-5 my-5">No se encontraron productos</p>
    @endif
</div>    



