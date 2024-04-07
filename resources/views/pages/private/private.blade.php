@extends('layouts.main')

@section('title', 'AREA PERSONAL')

@section('content')
<div class="pt-5 mt-5 px-0 mx-auto">

<div class="row ">
    <div class="col">
        <div class="card mb-3 m-0 px-0 pb-5 " style="width: 600px;">
            @include('panels.index')
        </div>
    </div>
</div>

<div > 
    <p class="animated rotate 2s infinite"> HOLA </p>
    <img class="" src="{{ asset('img/cd_icon.png') }}" alt="Icono de CD" style="animation: rotate 2s infinite">
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