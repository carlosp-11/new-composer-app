@extends('layouts.main')

@section('title', $modo == 'login' ? 'INGRESAR' : 'REGISTRARSE')

@section('content')
    <div class="text-center mx-5">
        <h1 class="text-center text-secondary pt-5 fw-light" >{{  $modo == 'login' ? 'Iniciar sesión': 'Regístrate' }}</h1>
    </div> 
    <div class="mx-5">
        <form action="{{ $modo == 'login' ? url('/login') : url('/signup') }}" 
        method="POST" class="py-3 px-3" id="formulario">
            @csrf            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Escribe tu email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Escribe tu contraseña">
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
        </form>
        <div class="pt-5 text-center"> 
            <a href="{{ url('/signup') }}" class=""> ¿No estás registrado? </a>
        </div>
    </div>
@endsection
