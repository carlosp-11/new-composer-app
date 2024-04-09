@extends('layouts.main')

@section('title', 'CATEGORIAS')

@section('content')

    <div class="pt-5 mt-3 px-0">
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 m-0 p-0">
            @foreach ($categorias as $row)
                <div class="col ms-auto me-auto">            
                    <div class="card mx-auto animated fadeInUp bg-light shadow" style="min-width:15rem">
                        <a class="bg-secondary bg-opacity-50 text-center rounded-top border border-light" 
                            href="#"
                        > 
                            <img src="{{ asset('img/tag.png') }}" class="card-img-top " 
                                alt="Almacen" style="width: 15rem;" 
                            />
                        </a>
                        <div class="card-body">
                            <a class="text-decoration-none" href="#">
                                <h5 class="card-title pb-2"> {{ $row->nombre }} </h5>
                            </a>
                            <p class="card-text align-self-center">
                                {{ $row->descripcion }}
                            </p>
                            <div class="row justify-content-end">
                                <a href="{{ url('categorias/'. $row->id).'/editar' }}" 
                                    class="btn col-6"
                                >
                                    <i class="fa-solid fa-pen text-secondary fs-4"></i>
                                </a> 
                                <div class="col-6 text-center">
                                    <button type="button" class="btn text-center" data-bs-toggle="modal" 
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
                                    Este cambio puede afectar a los productos 
                                    asociados a esta categoría 
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" 
                                    data-bs-dismiss="modal"
                                >
                                    Cancelar
                                </button>
                                <form method="POST" action= "{{url('categorias/'. $row->id)}}" > 
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
        </div>
        
        <div class="my-5 animated fadeInDown">
            <div class="pb-5 text-center px-0 mx-auto"> 
                <a href="{{ url('/crear-categoria') }}" class="rounded-circle" > 
                    <i class="fa-solid fa-circle-plus display-2"></i> 
                </a>
            </div>
        </div>

        <div class="animated fadeInDown">
            <nav class="py-5 mx-auto" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $categorias->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categorias->previousPageUrl() }}">
                            Anterior
                        </a>
                    </li>

                    @foreach ($categorias->getUrlRange(1, $categorias->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $categorias->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $categorias->currentPage() == $categorias->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categorias->nextPageUrl() }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> 
@endsection