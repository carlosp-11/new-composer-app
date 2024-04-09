<div id="lista-productos" class="row g-4 m-0 p-0">
    @if(!empty($productos[0]))
        @foreach ($productos as $row)
            <div class="col-12 col-md-4 col-lg-3 ms-auto me-auto">            
                <div class="card mx-auto animated fadeInUp bg-light shadow" style="min-width:15rem">
                    <a class="bg-secondary bg-opacity-50 text-center rounded-top border border-light" 
                        href="#"
                    > 
                        <img src="{{ asset('img/pack.png') }}" class="img-fluid rounded-start" 
                            alt="Producto" style="width: 15rem;" 
                        >
                    </a>
                    <div class="card-body">
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
                            <button type="button" class="btn btn-secondary" 
                                data-bs-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <form method="POST" action= "{{url('productos/'.$row->id)}}">
                            @csrf
                            @method('DELETE') 
                                <button type="submit" class="btn btn-danger">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col">
            <div class="card mx-auto animated fadeInUp bg-light shadow text-center" style="width:15rem">
                <img src="{{ asset('img/empty.png') }}" class="img-fluid rounded-start" 
                    alt="Producto" style="width: 15rem;" 
                >
               <div class="card-body text-center">
                    <h5 class="card-title pb-2"> ¡Vaya...! </h5>
                    <p>No hay resultados</p>
               </div>
           </div>
       </div>
    @endif
</div>    



