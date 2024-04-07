@extends('layouts.main')

@section('title', 'Home')

@section('content') 
    <div class="pt-5 mt-5 px-0 mx-0">           
        <div class="row m-0">
            <div class="pt-5 col-12 col-sm-6 justify-content-center text-center align-self-center">
                <a class="animated fadeIn text-decoration-none" href="/almacenes">  
                    <img src="{{ asset('img/centro-de-distribucion.png') }}" 
                        class="img-thumbnail rounded border-secondary" 
                        alt="gestionar almacén" style="max-height:12rem"
                    >
                    <h4 class="text-secondary fw-lighter"> Gestionar Almacenes </h4>
                </a>
            </div>
            <div class="pt-5 col-12 col-sm-6 justify-content-center text-center align-self-center">     
                <a class="animated fadeIn text-decoration-none" href="/productos"> 
                    <img src="{{ asset('img/gestion_prod.png') }}" 
                        class="m-0 img-thumbnail rounded border-secondary" 
                        alt="gestionar un producto" style="max-height:12rem"
                    >
                    <h4 class="text-secondary fw-lighter"> Gestionar Productos </h4>
                </a>
            </div>
        </div>
    </div>
@endsection

