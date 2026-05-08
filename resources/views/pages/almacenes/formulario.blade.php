@extends('layouts.main')

@section('title', $modo === 'crear' ? 'Crear almacén' : 'Editar almacén')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-2xl mx-auto">
    <header class="mb-5">
        <a href="{{ url('/almacenes') }}" class="inline-flex items-center gap-1 text-sm text-ink-500 hover:text-ink-700">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            Volver a almacenes
        </a>
        <h1 class="mt-2 text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">
            {{ $modo === 'crear' ? 'Crear almacén' : 'Editar almacén' }}
        </h1>
        <p class="mt-1 text-sm text-ink-500">
            {{ $modo === 'crear'
                ? 'Define un espacio físico para guardar productos.'
                : 'Actualiza la información del almacén.' }}
        </p>
    </header>

    <form action="{{ $modo === 'crear' ? url('/crear-almacen') : url('/almacenes/'.$almacen->id.'/editar') }}"
          method="POST" class="space-y-5" id="formulario">
        @csrf
        @if($modo === 'editar')
            @method('PUT')
        @endif

        @if($errors->any())
            <div role="alert" class="rounded-md border border-danger/30 bg-red-50 px-4 py-3 text-sm text-danger">
                <p class="font-medium">Revisa los campos marcados:</p>
                <ul class="mt-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-card>
            <div class="space-y-4">
                <div>
                    <label class="label" for="nombre">Nombre del almacén</label>
                    <input type="text" id="nombre" name="nombre" required
                           class="input"
                           placeholder="Ej.: Sede norte"
                           value="{{ old('nombre', $modo === 'editar' ? $almacen->nombre : '') }}">
                </div>

                <div>
                    <label class="label" for="descripcion">Descripción <span class="font-normal text-ink-500">(opcional)</span></label>
                    <textarea id="descripcion" name="descripcion" rows="2"
                              class="input h-auto py-2 leading-relaxed"
                              placeholder="Ubicación o referencias internas">{{ old('descripcion', $modo === 'editar' ? $almacen->descripcion : '') }}</textarea>
                </div>

                <div>
                    <label class="label" for="slots">Capacidad</label>
                    <input type="number" id="slots" name="slots" min="1" max="9999" required
                           class="input tabular-nums"
                           placeholder="Número máximo de productos"
                           value="{{ old('slots', $modo === 'editar' ? $almacen->slots : 100) }}">
                    <p class="mt-1.5 text-xs text-ink-500">Número máximo de productos distintos que puede albergar. Puedes cambiarlo después.</p>
                </div>
            </div>
        </x-card>

        <div class="flex flex-wrap gap-2 justify-end">
            <a href="{{ url('/almacenes') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary">
                {{ $modo === 'crear' ? 'Crear almacén' : 'Guardar cambios' }}
            </button>
        </div>
    </form>
</section>
@endsection
