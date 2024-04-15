@extends('layouts.main')

@section('title', 'AREA PERSONAL')

@section('content')

    <div class="mt-5 px-0 mx-0">  
        <div class="row m-0 p-0 g-5 ">
            <div class="col">
            <div class="card mx-auto animated fadeInUp  bg-gradient bg-light shadow" style="min-width:15rem">
                    <a class="bg-secondary  bg-gradient bg-opacity-50 text-center rounded-top border border-light" 
                        href="#"
                    > 
                        <img src="{{ asset('img/centro-de-distribucion.png') }}"  
                            class="card-img-top " 
                            alt="Almacen" style="width: 15rem;" 
                        />
                    </a>
                    <div class="card-body">
                        <a class="text-decoration-none " href="/almacenes"> 
                            <h5 class="card-title pb-2">  ALMACENES </h5>
                        </a>
                        <p class="card-text align-self-center">
                        TOTAL Almacenes: {{$numeroAlmacenes}}
                        </p>      
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class = "card border-dark mb-3 bg-primary bg-gradient shadow mx-auto animated fadeIn px-2 py-3" 
                    style = "width:22rem"
                >
                    <a class=" text-decoration-none " href="/almacenes">
                        <div class="row g-0 align-items-center">
                            <div class="col-5 text-center">
                                <h4 class="text-white fw-light text-nowrap "> ALMACENES </h4>
                            </div>
                            <div class="col-7 justify-content-center text-center">
                                <img src="{{ asset('img/centro-de-distribucion.png') }}" 
                                    class="bg-primary bg-gradient" 
                                    alt="gestionar almacén" style="max-height:44px"
                                >
                            </div>
                            <p class="col card-text align-self-center"> TOTAL Almacenes: {{$numeroAlmacenes}}</p>

                        </div>
                    </a>    
                </div>
            </div>


    <div class="row ">
        <div class="col">            
            <div class="card mb-3" style="width: 600px;">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body mx-2">   
                            <div class="row justify-content-between py-1">                               
                                <p class="col card-text align-self-center"> TOTAL Almacenes: {{$numeroAlmacenes}}</p>
                                <a href="#" class=" col btn btn-secondary align-self-center">Borrar todos los almacenes</a>
                            </div>
                            <div class="row justify-content-between py-1">
                                <p class="col card-text align-self-center"> TOTAL Categorías: {{$numeroCategorias}}</p>
                                <a href="#" class="col btn btn-secondary align-self-center">Borrar todos las categorías</a>
                            </div>
                            <div class="row justify-content-between py-1">
                                <p class="col card-text align-self-center"> TOTAL Productos: {{$numeroProductos}}</p>
                                <a href="#" class="col btn btn-secondary align-self-center">Borrar todos los productos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row ">
        <div class="col">            
            <div class="card mb-3" style="width: 600px;">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body">
                            <div class="justify-content-between d-flex">
                                <span class="d-flex">
                                    <h5 class="card-title"> Cuenta: </h5>
                                    <p class="ms-2"> {{$correoElectronico}}</p>
                                </span>  
                                <span>
                                    <span>creada el:
                                        
                                    </span> {{$fechaCreacion}}
                                </span>
                            </div>
                            <div class="row justify-content-between px-2">
                                <a href="#" class="btn btn-secondary col-11 col-md-4 my-1 py-2"> Cambiar contraseña </a>
                                <a href="#" class="btn btn-danger col-12 col-md-4 my-1 py-2"> Darse de baja </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 50px;">
        <h1>Enviar Correo de Bienvenida</h1>
        <form method="POST" action="{{ route('enviar-bienvenida') }}">
            @csrf
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px;">Enviar Correo de Bienvenida</button>
        </form>
    </div>
    
</div>
@endsection