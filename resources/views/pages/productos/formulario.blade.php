@extends('layouts.main')

@section('title', $modo === 'crear' ? 'Crear producto' : 'Editar producto')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-3xl mx-auto">
    <header class="mb-5">
        <a href="{{ url('/productos') }}" class="inline-flex items-center gap-1 text-sm text-ink-500 hover:text-ink-700">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            Volver a productos
        </a>
        <h1 class="mt-2 text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">
            {{ $modo === 'crear' ? 'Crear producto' : 'Editar producto' }}
        </h1>
        <p class="mt-1 text-sm text-ink-500">
            {{ $modo === 'crear'
                ? 'Datos básicos y categorías. Generaremos su código QR automáticamente.'
                : 'Actualiza los datos del producto.' }}
        </p>
    </header>

    <form action="{{ $modo === 'crear' ? url('/crear-producto') : url('/productos/'.$producto->id.'/editar') }}"
          method="POST" id="formulario" enctype="multipart/form-data" class="space-y-5">
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
            <h2 class="text-base font-semibold text-ink-950 mb-4">Datos del producto</h2>
            <div class="space-y-4">
                <div>
                    <label class="label" for="nombre">Nombre del producto</label>
                    <input type="text" id="nombre" name="nombre" required
                           class="input"
                           placeholder="Ej.: Caja de tornillos M6"
                           value="{{ old('nombre', $modo === 'editar' ? $producto->nombre : '') }}">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="label" for="precio">Precio (€)</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0.01" required
                               class="input tabular-nums"
                               placeholder="0,00"
                               value="{{ old('precio', $modo === 'editar' ? $producto->precio : '') }}">
                    </div>
                    <div>
                        <label class="label" for="almacen">Almacén</label>
                        <select id="almacen" name="almacen" required class="input">
                            @forelse($almacenes as $option)
                                <option value="{{ $option->id }}"
                                    {{ old('almacen', $modo === 'editar' ? $producto->almacen : null) == $option->id ? 'selected' : '' }}>
                                    {{ $option->nombre }}
                                </option>
                            @empty
                                <option value="" disabled>No tienes almacenes — crea uno primero</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div>
                    <label class="label" for="descripcion">Descripción <span class="font-normal text-ink-500">(opcional)</span></label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                              class="input h-auto py-2 leading-relaxed"
                              placeholder="Notas internas, referencia del proveedor…">{{ old('descripcion', $modo === 'editar' ? $producto->descripcion : '') }}</textarea>
                </div>
            </div>
        </x-card>

        <x-card>
            <h2 class="text-base font-semibold text-ink-950 mb-4">Categorías</h2>
            @if($categorias->isEmpty())
                <p class="text-sm text-ink-500">
                    No tienes categorías definidas.
                    <a href="{{ url('/crear-categoria') }}" class="font-medium text-brand-600 hover:underline">Crear una categoría</a>.
                </p>
            @else
                <div class="grid sm:grid-cols-2 gap-2">
                    @foreach($categorias as $categoria)
                        @php
                            $marcada = $modo === 'editar'
                                ? $productosCategorias->where('id_producto', $producto->id)->where('id_categoria', $categoria->id)->isNotEmpty()
                                : in_array($categoria->id, old('categorias', []));
                        @endphp
                        <label class="flex items-center gap-2 px-3 h-11 rounded-md border border-line bg-card cursor-pointer hover:border-brand-500 transition duration-120 ease-out-soft has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50">
                            <input type="checkbox" name="categorias[]"
                                   value="{{ $categoria->id }}"
                                   class="h-4 w-4 rounded border-line text-brand-600 focus:ring-brand-600 focus:ring-offset-0"
                                   {{ $marcada ? 'checked' : '' }}>
                            <span class="text-sm text-ink-700">{{ $categoria->nombre }}</span>
                        </label>
                    @endforeach
                </div>
            @endif
        </x-card>

        <x-card x-data="{ preview: null, name: null, size: null }">
            <h2 class="text-base font-semibold text-ink-950 mb-1">Foto del producto <span class="font-normal text-ink-500">(opcional)</span></h2>
            <p class="text-xs text-ink-500 mb-4">Te ayuda a identificar el producto en la pizarra. Próximamente.</p>

            <label for="imagen"
                   class="block cursor-pointer rounded-lg border border-dashed border-line bg-elevated/50 hover:bg-elevated transition duration-120 ease-out-soft px-4 py-8 text-center"
                   :class="{ 'border-brand-600 bg-brand-50': preview }">
                <template x-if="!preview">
                    <div class="flex flex-col items-center gap-2 text-ink-500">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                        <p class="text-sm font-medium text-ink-700">Arrastra una imagen o haz clic para seleccionar</p>
                        <p class="text-xs">JPG o PNG, máx 5 MB</p>
                    </div>
                </template>
                <template x-if="preview">
                    <div class="flex flex-col items-center gap-3">
                        <img :src="preview" alt="Vista previa" class="max-h-48 rounded-md object-contain">
                        <p class="text-xs text-ink-500">
                            <span x-text="name"></span>
                            ·
                            <span x-text="size"></span>
                        </p>
                        <button type="button"
                                class="text-xs font-medium text-danger hover:underline"
                                @click.prevent="preview = null; name = null; size = null; document.getElementById('imagen').value = ''">
                            Quitar imagen
                        </button>
                    </div>
                </template>
            </label>
            <input id="imagen" name="imagen" type="file"
                   accept="image/jpeg,image/png,image/webp"
                   class="sr-only"
                   @change="
                        const file = $event.target.files[0];
                        if (!file) return;
                        if (file.size > 5 * 1024 * 1024) {
                            alert('La imagen supera los 5 MB');
                            $event.target.value = '';
                            return;
                        }
                        name = file.name;
                        size = (file.size / 1024).toFixed(0) + ' KB';
                        const reader = new FileReader();
                        reader.onload = (e) => preview = e.target.result;
                        reader.readAsDataURL(file);
                   ">
        </x-card>

        <div class="flex flex-wrap gap-2 justify-end">
            <a href="{{ url('/productos') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary">
                {{ $modo === 'crear' ? 'Crear producto' : 'Guardar cambios' }}
            </button>
        </div>
    </form>
</section>
@endsection
