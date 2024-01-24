@extends('layouts.main')

@section('title', $modo == 'crear' ? 'CREAR UN ALMACEN' : 'EDITAR UN ALMACEN')

@section('content')
    <div class="text-center mx-5">
        <h1 class="text-center text-secondary pt-5 fw-light">{{  $modo == 'crear' ? 'Crea': 'Edita' }} un almacén</h1>
    </div> 
    <div class="mx-5">
        <form action="{{ $modo == 'crear' ? url('/crear-almacen') : url('/almacenes/'.$almacen->id).'/editar' }}" 
        method="POST" class="py-3 px-3" id="formulario">
            @csrf
            @if($modo == 'editar')
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre del almacén" value="{{ $modo == 'editar' ? $almacen->nombre : ''}}">
            </div>
            <button type="submit" class="btn btn-primary mb-4 text-center">Crear</button>
            <a href="{{ url('/almacenes') }}" class="btn btn-secondary mb-4 text-center">Cancelar</a>
        </form>
    </div>
@endsection
