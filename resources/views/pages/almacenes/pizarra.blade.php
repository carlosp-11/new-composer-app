@extends('layouts.main')

@section('title', 'ALMACENES')

@section('content')

    <div class="pt-5 mt-5 px-0 mx-auto">
        @foreach ($almacenes as $row)             
            <div class="row ">
                <div class="col">            
                    <div class="card mb-3" style="max-width: 600px;">
                        <div class="row g-0">
                            <div class="col-md-4 align-self-center text-center">
                                <img src="{{ asset('img/warehouse.webp') }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body pe-3">
                                    <h5 class="card-title"> {{ $row->nombre }} </h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="row justify-content-end">
                                        <a href="{{ url('almacenes/'. $row->id).'/editar' }}" class="btn col-2">
                                            <i class="fa-solid fa-pen text-secondary fs-4"></i>
                                        </a> 
                                        <form method="POST" action= "{{url('almacenes/'. $row->id)}}" class=" col-2">
                                            @csrf
                                            @method('DELETE')  
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="fa-solid fa-trash-can text-secondary fs-4"></i>
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title"> ¿Seguro que deseas borrar? </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class=""> Este cambio puede afectar a los productos asociados a este almacén </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
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
                <a href="{{ url('/crear-almacen') }}" class="rounded-circle" > 
                    <i class="fa-solid fa-circle-plus fs-1"></i> 
                </a>
            </div>
        </div>

        <div class="">
            <nav class="py-5 mx-auto" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $almacenes->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $almacenes->previousPageUrl() }}">
                            Anterior
                        </a>
                    </li>

                    @foreach ($almacenes->getUrlRange(1, $almacenes->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $almacenes->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $almacenes->currentPage() == $almacenes->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $almacenes->nextPageUrl() }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> 
@endsection