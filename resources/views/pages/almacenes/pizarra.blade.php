@extends('layouts.main')

@section('title', 'Almacenes')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-7xl mx-auto space-y-5">
    <header class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">Almacenes</h1>
            <p class="mt-1 text-sm text-ink-500">Define los espacios donde se guardan tus productos.</p>
        </div>
        <a href="{{ url('/crear-almacen') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14"/><path d="M5 12h14"/>
            </svg>
            Crear almacén
        </a>
    </header>

    @if($almacenes->isEmpty())
        <x-empty-state
            title="Aún no tienes almacenes"
            description="Para empezar a registrar productos, define al menos un almacén con su capacidad.">
            <a href="{{ url('/crear-almacen') }}" class="btn-primary">Crear primer almacén</a>
        </x-empty-state>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($almacenes as $row)
                @php
                    $count = $row->productos_count ?? 0;
                    $slots = max((int) $row->slots, 1);
                    $pct = min(100, (int) round(($count / $slots) * 100));
                    $tone = $pct >= 90 ? 'bg-danger' : ($pct >= 70 ? 'bg-warn' : 'bg-brand-600');
                @endphp
                <article class="bg-card rounded-lg border border-line shadow-soft-1 p-5 transition duration-120 ease-out-soft hover:shadow-soft-2 hover:-translate-y-0.5 flex flex-col">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2 text-brand-600 mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/>
                                    <path d="M6 18h12"/>
                                    <path d="M6 14h12"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-ink-950 line-clamp-2 leading-snug">{{ $row->nombre }}</h3>
                            @if($row->descripcion)
                                <p class="mt-1 text-sm text-ink-500 line-clamp-2">{{ $row->descripcion }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <a href="{{ url('almacenes/'.$row->id.'/editar') }}"
                               class="inline-flex items-center justify-center h-9 w-9 rounded-md text-ink-700 hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2"
                               title="Editar"
                               aria-label="Editar {{ $row->nombre }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            <button type="button"
                                    class="inline-flex items-center justify-center h-9 w-9 rounded-md text-ink-700 hover:bg-red-50 hover:text-danger focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2"
                                    title="Eliminar"
                                    aria-label="Eliminar {{ $row->nombre }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteAlmacen-{{ $row->id }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-baseline justify-between text-xs text-ink-500 mb-1.5">
                            <span>Ocupación</span>
                            <span class="tabular-nums font-medium text-ink-700">{{ $count }}/{{ $slots }}</span>
                        </div>
                        <div class="h-1.5 bg-elevated rounded-full overflow-hidden">
                            <div class="h-full {{ $tone }} transition-all duration-120 ease-out-soft" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>

                    {{-- Modal eliminar --}}
                    <div class="modal fade" id="deleteAlmacen-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-soft-2 rounded-lg overflow-hidden">
                                <div class="px-5 pt-5">
                                    <h2 class="text-lg font-semibold text-ink-950">¿Eliminar "{{ $row->nombre }}"?</h2>
                                    <p class="mt-1 text-sm text-ink-500">
                                        @if($count > 0)
                                            Los <strong class="text-ink-700">{{ $count }} producto{{ $count === 1 ? '' : 's' }}</strong> asignado{{ $count === 1 ? '' : 's' }} a este almacén quedará{{ $count === 1 ? '' : 'n' }} sin ubicación.
                                        @else
                                            Esta acción no se puede deshacer.
                                        @endif
                                    </p>
                                </div>
                                <div class="px-5 py-4 flex flex-wrap gap-2 justify-end">
                                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form method="POST" action="{{ url('almacenes/'.$row->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-md px-4 h-11 text-sm font-medium bg-danger text-white hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2">
                                            Eliminar almacén
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if($almacenes->hasPages())
            <nav aria-label="Paginación de almacenes" class="flex items-center justify-center gap-1">
                @if($almacenes->onFirstPage())
                    <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed">Anterior</span>
                @else
                    <a href="{{ $almacenes->previousPageUrl() }}" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated">Anterior</a>
                @endif
                @foreach($almacenes->getUrlRange(1, $almacenes->lastPage()) as $page => $url)
                    @if($page === $almacenes->currentPage())
                        <span class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm font-medium bg-brand-600 text-white tabular-nums" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated tabular-nums">{{ $page }}</a>
                    @endif
                @endforeach
                @if($almacenes->currentPage() === $almacenes->lastPage())
                    <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed">Siguiente</span>
                @else
                    <a href="{{ $almacenes->nextPageUrl() }}" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated">Siguiente</a>
                @endif
            </nav>
        @endif
    @endif
</section>
@endsection
