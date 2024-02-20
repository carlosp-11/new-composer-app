@extends('layouts.main')

@section('title', $modo == 'crear' ? 'CREAR UN ALMACEN' : 'EDITAR UN ALMACEN')

@section('content')
    <div class="pt-5 mt-5  mx-auto">
        <div class="card mb-3 px-0  mx-5" style="max-width: 600px;">
            <div class="row g-0 mx-0 p-0">
                <div class="card-header">
                    <h1 class="text-center text-secondary fw-light"> 
                    {{  $modo == 'crear' ? 'Crea': 'Edita' }} un almacén
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ $modo == 'crear' ? url('/crear-almacen') : url('/almacenes/'.$almacen->id).'/editar' }}" 
                        method="POST" class="py-3 px-3" id="formulario"
                    >
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
            </div>
        </div>
    </div>
@endsection
