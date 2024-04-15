@extends('layouts.home')

@section('title', $modo == 'login' ? 'INGRESAR' : 'REGISTRARSE')

@section('content')
<div class="m-0 p-0 animated fadeInDown">
    <div class="row mt-5 mx-0 align-items-center gx-4 gy-5">
        <div class= " col-12 col-lg-6">
            <div class="row gx-3 justify-content-center">
                <div class="col-auto align-self-center">
                    <img class="rotating-image " 
                        src="{{ asset('img/cd_icon.png') }}" alt="C"
                        style="max-width: 5rem; height: auto;"   
                    >
                </div>
                <div class="col-auto align-self-center">
                    <img class="img-fluid" 
                        src="{{ asset('img/depot_letter.png') }}" alt="DEPOT"
                        style="max-width: 18rem;"
                    >
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 ">
            <div class="row justify-content-center px-3 mt-5">           
                <div class="shadow card mb-3" style="max-width: 600px;">
                    <div class="row g-0">
                        <div class="col ">
                            <div class="card-body pe-3">    
                                <form action="{{ $modo == 'login' ? url('/login') : url('/signup') }}" 
                                    method="POST" class="py-3 px-0" id="formulario"
                                >
                                    @csrf            
                                    <div class="my-3 form-floating">
                                        <input type="email" class="form-control  fs-6 fw-light" 
                                            id="email" name="email" placeholder="Correo electrónico"
                                        >
                                        <label class="fs-6 fw-light" for="email">Correo electrónico</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <input type="password" class="form-control py-2 fs-6 fw-light" 
                                            id="password" name="password" placeholder="Contraseña"
                                        >
                                        <label class="fs-6 fw-light" for="password">Contraseña</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 
                                        my-2 fw-semibold py-2 fs-5 bg-gradient"
                                        >
                                        {{$modo== 'login'? 'Ingresar':'Registrarse'  }}
                                    </button>
                                    <div class="text-center mt-3">
                                        <a class="text-decoration-none" href="#"> 
                                            ¿Has olvidado la contraseña? 
                                        </a>      
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-transparent border-tertiary">
                                <div class="text-center py-3">
                                    <a href="{{ $modo == 'login'? url('/signup') : url('/') }}" 
                                        class=" {{$modo== 'login'? 'btn btn-success':'btn btn-secondary' }} 
                                        w-50 fw-semibold py-2 fs-6 bg-gradient"
                                    > 
                                        {{$modo== 'login'? 'Crea una cuenta nueva':'Volver'  }}
                                    </a> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection