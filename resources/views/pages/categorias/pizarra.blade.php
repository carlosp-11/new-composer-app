@extends('layouts.main')

@section('title', 'Categorías')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-7xl mx-auto space-y-5">
    <header class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">Categorías</h1>
            <p class="mt-1 text-sm text-ink-500">Agrupa productos para encontrarlos rápido en la pizarra.</p>
        </div>
        <a href="{{ url('/crear-categoria') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14"/><path d="M5 12h14"/>
            </svg>
            Crear categoría
        </a>
    </header>

    @if($categorias->isEmpty())
        <x-empty-state
            title="No hay categorías todavía"
            description="Las categorías te ayudan a clasificar y filtrar productos. Crea al menos una antes de añadir tus productos.">
            <a href="{{ url('/crear-categoria') }}" class="btn-primary">Crear primera categoría</a>
        </x-empty-state>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($categorias as $row)
                <article class="bg-card rounded-lg border border-line shadow-soft-1 p-4 transition duration-120 ease-out-soft hover:shadow-soft-2 hover:-translate-y-0.5 flex flex-col">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2 text-accent-600 mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 7.8a2 2 0 0 1 .6-1.4l3.4-3.4a2 2 0 0 1 1.4-.6h6.8a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 0 2.8L12 19l-9-9.2z"/>
                                    <path d="M14 7h.01"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-ink-950 line-clamp-2 leading-snug">{{ $row->nombre }}</h3>
                            @if($row->descripcion)
                                <p class="mt-1 text-sm text-ink-500 line-clamp-3">{{ $row->descripcion }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <a href="{{ url('categorias/'.$row->id.'/editar') }}"
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
                                    data-bs-target="#deleteCategoria-{{ $row->id }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Modal eliminar --}}
                    <div class="modal fade" id="deleteCategoria-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-soft-2 rounded-lg overflow-hidden">
                                <div class="px-5 pt-5">
                                    <h2 class="text-lg font-semibold text-ink-950">¿Eliminar "{{ $row->nombre }}"?</h2>
                                    <p class="mt-1 text-sm text-ink-500">
                                        Los productos con esta categoría la perderán, pero no serán eliminados.
                                    </p>
                                </div>
                                <div class="px-5 py-4 flex flex-wrap gap-2 justify-end">
                                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form method="POST" action="{{ url('categorias/'.$row->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-md px-4 h-11 text-sm font-medium bg-danger text-white hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2">
                                            Eliminar categoría
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if($categorias->hasPages())
            <nav aria-label="Paginación de categorías" class="flex items-center justify-center gap-1">
                @if($categorias->onFirstPage())
                    <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed">Anterior</span>
                @else
                    <a href="{{ $categorias->previousPageUrl() }}" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated">Anterior</a>
                @endif
                @foreach($categorias->getUrlRange(1, $categorias->lastPage()) as $page => $url)
                    @if($page === $categorias->currentPage())
                        <span class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm font-medium bg-brand-600 text-white tabular-nums" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated tabular-nums">{{ $page }}</a>
                    @endif
                @endforeach
                @if($categorias->currentPage() === $categorias->lastPage())
                    <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed">Siguiente</span>
                @else
                    <a href="{{ $categorias->nextPageUrl() }}" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated">Siguiente</a>
                @endif
            </nav>
        @endif
    @endif
</section>
@endsection
