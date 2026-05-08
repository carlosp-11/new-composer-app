@extends('layouts.main')

@section('title', $producto->nombre)

@section('content')
@php
    $estadosLabels = [
        'en stock' => 'En almacén',
        'en transito' => 'En tránsito',
        'despachado' => 'Despachado',
        'con incidencia' => 'Con incidencia',
        'producto registrado' => 'Producto registrado',
    ];
    $estadosTone = [
        'en stock' => 'bg-brand-50 text-brand-600',
        'en transito' => 'bg-amber-50 text-warn',
        'despachado' => 'bg-green-50 text-success',
        'con incidencia' => 'bg-red-50 text-danger',
    ];
    $ultimoEstado = $status->last();
    $ultimoLabel = $estadosLabels[$ultimoEstado?->status] ?? ucfirst($ultimoEstado?->status ?? 'Sin estado');
    $ultimoTone = $estadosTone[$ultimoEstado?->status] ?? 'bg-elevated text-ink-700';
    $almacenSeleccionado = $almacenes->find($producto->almacen);
    $categoriasIds = $productosCategorias->pluck('id_categoria');
@endphp
<section class="px-4 sm:px-6 py-6 max-w-5xl mx-auto space-y-5">
    <header class="flex flex-wrap items-start justify-between gap-3">
        <div class="flex-1 min-w-0">
            <a href="{{ url('/productos') }}" class="inline-flex items-center gap-1 text-sm text-ink-500 hover:text-ink-700">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                Volver a productos
            </a>
            <h1 class="mt-2 text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">{{ $producto->nombre }}</h1>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 h-7 text-xs font-medium {{ $ultimoTone }}">
                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                    {{ $ultimoLabel }}
                </span>
                <span class="text-sm text-ink-500">
                    {{ $almacenSeleccionado?->nombre ?? 'Sin almacén' }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ url('productos/'.$producto->id.'/editar') }}" class="btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Editar
            </a>
            <button type="button" class="btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Eliminar
            </button>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        {{-- Columna izquierda: foto + info --}}
        <div class="lg:col-span-2 space-y-5">
            <x-card :padded="false">
                <div class="aspect-video lg:aspect-[16/9] bg-elevated flex items-center justify-center text-ink-500 rounded-t-lg overflow-hidden">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <path d="M3.27 6.96 12 12.01l8.73-5.05"/>
                        <path d="M12 22.08V12"/>
                    </svg>
                </div>
                <div class="p-5 sm:p-6 space-y-4">
                    <div>
                        <p class="text-xs font-medium text-ink-500 uppercase tracking-wide">Precio</p>
                        <p class="mt-1 text-2xl font-semibold text-ink-950 tabular-nums">{{ number_format($producto->precio, 2, ',', '.') }} €</p>
                    </div>
                    @if($producto->descripcion)
                        <div>
                            <p class="text-xs font-medium text-ink-500 uppercase tracking-wide">Descripción</p>
                            <p class="mt-1 text-sm text-ink-700 whitespace-pre-line">{{ $producto->descripcion }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-xs font-medium text-ink-500 uppercase tracking-wide">Categorías</p>
                        <div class="mt-1.5 flex flex-wrap gap-1">
                            @forelse($categoriasIds as $item)
                                @php $cat = $categorias->find($item); @endphp
                                @if($cat)
                                    <span class="chip">{{ $cat->nombre }}</span>
                                @endif
                            @empty
                                <span class="text-sm text-ink-500">Sin categoría</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        {{-- Columna derecha: QR --}}
        <aside class="lg:col-span-1">
            <x-card>
                <h2 class="text-base font-semibold text-ink-950 mb-3">Código QR</h2>
                <div class="rounded-md bg-elevated p-4 flex items-center justify-center">
                    <img src="{{ route('producto.qr.svg', $producto->id) }}"
                         alt="Código QR de {{ $producto->nombre }}"
                         class="w-full max-w-[200px] aspect-square bg-white p-3 rounded-md shadow-soft-1">
                </div>
                <div class="mt-3 grid grid-cols-2 gap-2">
                    <a href="{{ route('producto.qr.png', $producto->id) }}"
                       download="qr-producto-{{ $producto->id }}.png"
                       class="btn-secondary btn-sm justify-center">
                        Descargar PNG
                    </a>
                    <a href="{{ route('producto.qr.svg', $producto->id) }}"
                       download="qr-producto-{{ $producto->id }}.svg"
                       class="btn-secondary btn-sm justify-center">
                        Descargar SVG
                    </a>
                </div>
            </x-card>
        </aside>
    </div>

    {{-- Timeline de estados --}}
    <x-card>
        <header class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-ink-950">Historial de estados</h2>
            @if($ultimoEstado?->status !== 'despachado')
                <button type="button"
                        x-data="{}"
                        @click="document.getElementById('update-form').classList.toggle('hidden'); $event.currentTarget.classList.toggle('hidden')"
                        class="btn-primary btn-sm">
                    Registrar nuevo estado
                </button>
            @endif
        </header>

        <ol class="relative space-y-4">
            @foreach($status as $i => $estado)
                @php
                    $label = $estadosLabels[$estado->status] ?? ucfirst($estado->status);
                    $tone = $estadosTone[$estado->status] ?? 'bg-elevated text-ink-700';
                @endphp
                <li class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full text-xs font-semibold tabular-nums {{ $tone }}">
                            {{ $i + 1 }}
                        </span>
                        @if(!$loop->last)
                            <span class="flex-1 w-px bg-line my-1" aria-hidden="true"></span>
                        @endif
                    </div>
                    <div class="pb-2 flex-1 min-w-0">
                        <p class="text-sm font-medium text-ink-950">{{ $label }}</p>
                        @if($estado->descripcion)
                            <p class="mt-0.5 text-sm text-ink-500">{{ $estado->descripcion }}</p>
                        @endif
                        @if($estado->created_at)
                            <p class="mt-1 text-xs text-ink-500/80 tabular-nums">
                                {{ \Carbon\Carbon::parse($estado->created_at)->format('d/m/Y · H:i') }}
                            </p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>

        @if($ultimoEstado?->status !== 'despachado')
            <form id="update-form" action="{{ url('productos/'.$producto->id) }}" method="POST" class="hidden mt-5 pt-5 border-t border-line space-y-4">
                @csrf
                <input type="hidden" name="id_producto" value="{{ $producto->id }}">

                <div>
                    <label class="label" for="status">Nuevo estado</label>
                    <select id="status" name="status" required class="input">
                        <option value="en stock">En almacén</option>
                        <option value="en transito">En tránsito</option>
                        <option value="con incidencia">Con incidencia</option>
                        <option value="despachado">Despachado</option>
                    </select>
                </div>

                <div>
                    <label class="label" for="state-descripcion">Comentario <span class="font-normal text-ink-500">(opcional)</span></label>
                    <textarea id="state-descripcion" name="descripcion" rows="2"
                              class="input h-auto py-2 leading-relaxed"
                              placeholder="Detalle del cambio de estado…"></textarea>
                </div>

                <div class="flex gap-2 justify-end">
                    <button type="button" class="btn-secondary" @click="document.getElementById('update-form').classList.add('hidden')">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-primary">Confirmar estado</button>
                </div>
            </form>
        @endif
    </x-card>

    {{-- Modal eliminar --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-soft-2 rounded-lg overflow-hidden">
                <div class="px-5 pt-5">
                    <h2 class="text-lg font-semibold text-ink-950">¿Eliminar "{{ $producto->nombre }}"?</h2>
                    <p class="mt-1 text-sm text-ink-500">Esta acción no se puede deshacer.</p>
                </div>
                <div class="px-5 py-4 flex flex-wrap gap-2 justify-end">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ url('productos/'.$producto->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-md px-4 h-11 text-sm font-medium bg-danger text-white hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2">
                            Eliminar producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
