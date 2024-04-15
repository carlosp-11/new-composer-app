@extends('layouts.main')

@section('title', 'Home')

@section('content') 
    <div class="mt-5 px-0 mx-0">           
        <div class="row m-0 p-0 g-5 ">
            <div class="col-md-6">
                <div class = "card border-dark mb-3 bg-primary bg-gradient 
                    shadow mx-auto animated fadeIn px-2 py-3" 
                    style = "width:22rem"
                >
                    <a class=" text-decoration-none " href="/almacenes">
                        <div class="row g-0 align-items-center">
                            <div class="col-7 justify-content-center text-center">
                                <img src="{{ asset('img/centro-de-distribucion.png') }}" 
                                    class="bg-primary bg-gradient" 
                                    alt="gestionar almacén" style="max-height:12rem"
                                >
                            </div>
                            <div class="col-5 text-center">
                                <h4 class="text-white fw-light text-nowrap "> Almacenes </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient 
                    shadow mx-auto animated fadeIn px-2 py-3"  
                    style= "width:22rem"
                >
                    <a class=" text-decoration-none " href="/categorias">
                        <div class="row g-0 align-items-center">
                            <div class="col-7 justify-content-center text-center">
                                <img src="{{ asset('img/categories.webp') }}" 
                                    class="bg-primary bg-gradient" 
                                    alt="gestionar almacén" style="max-height:12rem"
                                >
                            </div>
                            <div class="col-5 text-center">
                                <h4 class="text-white fw-light text-nowrap"> Categorías </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient shadow mx-auto 
                    animated fadeIn px-2 py-3"  
                    style= "width:22rem"
                >
                    <a class=" text-decoration-none " href="/productos">
                        <div class="row g-0 align-items-center">
                            <div class="col-7 justify-content-center text-center">
                                <img src="{{ asset('img/boxes.png') }}" 
                                    class="bg-primary bg-gradient" 
                                    alt="gestionar almacén" style="max-height:12rem"
                                >
                            </div>
                            <div class="col-5 text-center">
                                <h4 class="text-white fw-light text-nowrap"> Productos </h4>
                            </div>
                        </div>
                    </a>    
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="card border-dark mb-3 bg-primary bg-gradient shadow mx-auto 
                    animated fadeIn px-2 py-3"  
                    style= "width:22rem"
                >
                    <a class=" text-decoration-none " href="/qrscanner">
                        <div class="row g-0 align-items-center">
                            <div class="col-7 justify-content-center text-center">
                                <img src="{{ asset('img/qr-code.png') }}" 
                                    class="bg-primary bg-gradient" 
                                    alt="gestionar almacén" style="max-height:12rem"
                                >
                            </div>
                            <div class="col-5 text-center">
                                <h4 class="text-white fw-light text-nowrap"> Escanear QR </h4>
                            </div>
                        </div>
                    </a>    
                </div>
        </div>
    </div>
@endsection

