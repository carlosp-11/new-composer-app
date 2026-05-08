@extends('layouts.main')

@section('title', $modo === 'crear' ? 'Crear categoría' : 'Editar categoría')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-2xl mx-auto">
    <header class="mb-5">
        <a href="{{ url('/categorias') }}" class="inline-flex items-center gap-1 text-sm text-ink-500 hover:text-ink-700">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            Volver a categorías
        </a>
        <h1 class="mt-2 text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">
            {{ $modo === 'crear' ? 'Crear categoría' : 'Editar categoría' }}
        </h1>
        <p class="mt-1 text-sm text-ink-500">
            {{ $modo === 'crear'
                ? 'Una etiqueta para agrupar productos similares.'
                : 'Actualiza la información de la categoría.' }}
        </p>
    </header>

    <form action="{{ $modo === 'crear' ? url('/crear-categoria') : url('/categorias/'.$categoria->id.'/editar') }}"
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
                    <label class="label" for="nombre">Nombre de la categoría</label>
                    <input type="text" id="nombre" name="nombre" required
                           class="input"
                           placeholder="Ej.: Tornillería"
                           value="{{ old('nombre', $modo === 'editar' ? $categoria->nombre : '') }}">
                </div>

                <div>
                    <label class="label" for="descripcion">Descripción <span class="font-normal text-ink-500">(opcional)</span></label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                              class="input h-auto py-2 leading-relaxed"
                              placeholder="Qué tipo de productos agrupa">{{ old('descripcion', $modo === 'editar' ? $categoria->descripcion : '') }}</textarea>
                </div>
            </div>
        </x-card>

        <div class="flex flex-wrap gap-2 justify-end">
            <a href="{{ url('/categorias') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary">
                {{ $modo === 'crear' ? 'Crear categoría' : 'Guardar cambios' }}
            </button>
        </div>
    </form>
</section>
@endsection
