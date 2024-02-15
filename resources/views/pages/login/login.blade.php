@extends('layouts.home')

@section('title', $modo == 'login' ? 'INGRESAR' : 'REGISTRARSE')

@section('content')
<div class="mt-0 p-0">
    <div class="row px-0 mx-0">
        <div class= "col-12 col-md-6">
            @include('panels.index')
        </div>
        <div class="col-12 col-md-6 px-5  mt-5">       
            <div class= "mt-5"> </div> 
            <div class="row justify-content-center mt-5">           
                <div class="card mb-3" style="max-width: 600px;">
                    <div class="row g-0">
                        <div class="col ">
                            <div class="card-body pe-3">    
                                <form action="{{ $modo == 'login' ? url('/login') : url('/signup') }}" 
                                    method="POST" class="py-3 px-0" id="formulario"
                                >
                                    @csrf            
                                    <div class="my-3">
                                        <input type="email" class="form-control py-2 fs-5" id="email" name="email" placeholder="Correo electónico">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control py-2 fs-5" id="password" name="password" placeholder="Contraseña">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 my-2 fw-bold py-2 fs-4">
                                        {{$modo== 'login'? 'Ingresar':'Registrarse'  }}
                                    </button>
                                    <div class="text-center py-3">
                                        <a href="{{ $modo == 'login'? url('/signup') : url('/') }}" class=" {{$modo== 'login'? 'btn btn-success':'btn btn-secondary'  }}  w-75  fw-bold py-1 fs-5"> 
                                            {{$modo== 'login'? 'Crea una cuenta nueva':'Volver'  }}
                                        </a> 
                                    </div>          
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection