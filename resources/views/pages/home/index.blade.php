@extends('layouts.main')

@section('title', 'Home')

@section('content') 
    <div class="my-5 px-0 mx-0">
        <div class="text-end pe-3">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-circle-question fs-1 animated pulse infinite"></i>
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">¿Por dónde comenzar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>1.- Comienza creando los almacenes en los que se guardarán los productos.</p> <br/>
                <p>2.- Crea las categorías que te necesites para agrupar tus productos.</p> <br/>
                <p>3.- Ya puedes empezar a registrar productos.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row m-0 p-0 g-5 ">
            <div class="col-md-6">
                <div class = "card border-dark mb-3 bg-primary bg-gradient 
                    shadow mx-auto animated fadeIn px-2 py-3" 
                    style = "width:20rem"
                >
                    <a class=" text-decoration-none " href="/almacenes">
                        <div class="row g-0 align-items-center">
                            <div class="col-2 col-sm-5 justify-content-center text-center">
                                <i class="fa-solid fa-warehouse fs-1 text-white d-block d-sm-none"></i>
                                <img src="{{ asset('img/centro-de-distribucion.png') }}" 
                                    class="bg-primary bg-gradient d-none d-sm-block" 
                                    alt="gestionar almacén" style="max-height:8rem"
                                >
                            </div>

                            <div class="col-10 col-sm-7 text-center">
                                <h4 class="text-white fw-light text-nowrap fs-2"> Almacenes </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient 
                    shadow mx-auto animated fadeIn px-2 py-3"  
                    style= "width:20rem"
                >
                    <a class=" text-decoration-none " href="/categorias ">
                        <div class="row g-0 align-items-center">
                            <div class="col-2 col-sm-5 justify-content-center text-center">
                                <i class="fa-solid fa-shapes fs-1 text-white d-block d-sm-none"></i>
                                <img src="{{ asset('img/categories.webp') }}" 
                                    class="bg-primary bg-gradient d-none d-sm-block" 
                                    alt="gestionar almacén" style="max-height:8rem"
                                >
                            </div>
                            <div class="col-10 col-sm-7 text-center">
                                <h4 class="text-white fw-light text-nowrap fs-2"> Categorías </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient shadow mx-auto 
                    animated fadeIn px-2 py-3"  
                    style= "width:20rem"
                >
                    <a class=" text-decoration-none " href="/productos">
                        <div class="row g-0 align-items-center">
                            <div class="col-2 col-sm-5 justify-content-center text-center">
                                <i class="fa-solid fa-box fs-1 text-white d-block d-sm-none"></i>
                                <img src="{{ asset('img/boxes.png') }}" 
                                    class="bg-primary bg-gradient d-none d-sm-block" 
                                    alt="gestionar almacén" style="max-height:8rem"
                                >
                            </div>
                            <div class="col-10 col-sm-7 text-center">
                                <h4 class="text-white fw-light text-nowrap fs-2"> Productos </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient shadow mx-auto 
                    animated fadeIn px-2 py-3"  
                    style= "width:20rem"
                >
                    <a class=" text-decoration-none " href="/qrscanner">
                        <div class="row g-0 align-items-center">
                            <div class="col-2 col-sm-5 justify-content-center text-center">
                                <i class="fa-solid fa-qrcode fs-1 text-white d-block d-sm-none"></i>
                                <img src="{{ asset('img/qr-code.png') }}" 
                                    class="bg-primary bg-gradient d-none d-sm-block" 
                                    alt="gestionar almacén" style="max-height:8rem"
                                >
                            </div>
                            <div class="col-10 col-sm-7 text-center">
                                <h4 class="text-white fw-light text-nowrap fs-2"> Escanear QR </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>
        </div>
    </div>
@endsection

