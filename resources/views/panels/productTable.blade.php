<div id="lista-productos" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @forelse($productos as $row)
        @php
            $imagenProducto = ($imagenes ?? collect())->where('id_producto', $row->id)->first();
            $almacenSeleccionado = $almacenes->find($row->almacen);
            $categoriasIds = $productosCategorias->where('id_producto', $row->id)->pluck('id_categoria');
        @endphp
        <article class="group bg-card rounded-lg border border-line shadow-soft-1 overflow-hidden flex flex-col transition duration-120 ease-out-soft hover:shadow-soft-2 hover:-translate-y-0.5">
            <a href="{{ url('productos/'.$row->id) }}" class="block relative aspect-square bg-elevated overflow-hidden">
                @if($imagenProducto)
                    <img src="{{ $imagenProducto->url }}" alt="{{ $row->nombre }}"
                         loading="lazy" decoding="async"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-ink-500">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <path d="M3.27 6.96 12 12.01l8.73-5.05"/>
                            <path d="M12 22.08V12"/>
                        </svg>
                    </div>
                @endif
                <button type="button"
                        class="absolute top-2 right-2 inline-flex items-center justify-center h-9 w-9 rounded-md bg-card/95 text-ink-700 shadow-soft-1 hover:bg-card focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2"
                        title="Ver código QR"
                        aria-label="Ver código QR de {{ $row->nombre }}"
                        data-bs-toggle="modal" data-bs-target="#imagenModal-{{ $row->id }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect width="6" height="6" x="3" y="3" rx="1"/>
                        <rect width="6" height="6" x="15" y="3" rx="1"/>
                        <rect width="6" height="6" x="3" y="15" rx="1"/>
                        <path d="M21 21v.01"/><path d="M15 15h.01"/><path d="M21 15h-2"/><path d="M15 18v3"/><path d="M21 18h-3v3"/>
                    </svg>
                </button>
            </a>

            <div class="p-3 sm:p-4 flex flex-col flex-1">
                <a href="{{ url('productos/'.$row->id) }}" class="block focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2 rounded">
                    <h3 class="text-sm sm:text-base font-semibold text-ink-950 line-clamp-2 leading-snug">{{ $row->nombre }}</h3>
                </a>
                <p class="mt-1 text-base font-semibold text-ink-950 tabular-nums">
                    {{ number_format($row->precio, 2, ',', '.') }} €
                </p>

                <div class="mt-2 flex flex-wrap gap-1">
                    @forelse($categoriasIds as $item)
                        @php $categoria = $categorias->find($item); @endphp
                        @if($categoria)
                            <span class="chip">{{ $categoria->nombre }}</span>
                        @endif
                    @empty
                        <span class="chip text-ink-500">Sin categoría</span>
                    @endforelse
                </div>

                <p class="mt-2 text-xs text-ink-500 truncate">
                    {{ $almacenSeleccionado?->nombre ?? 'Sin almacén' }}
                </p>

                <div class="mt-3 pt-3 border-t border-line flex items-center justify-end gap-1">
                    <a href="{{ url('productos/'.$row->id.'/editar') }}"
                       class="inline-flex items-center justify-center h-9 w-9 rounded-md text-ink-700 hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2"
                       title="Editar"
                       aria-label="Editar {{ $row->nombre }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </a>
                    <button type="button"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-md text-ink-700 hover:bg-red-50 hover:text-danger focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2"
                            title="Eliminar"
                            aria-label="Eliminar {{ $row->nombre }}"
                            data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $row->id }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 6h18"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Modal eliminar --}}
            <div class="modal fade" id="exampleModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-soft-2 rounded-lg overflow-hidden">
                        <div class="px-5 pt-5">
                            <h2 class="text-lg font-semibold text-ink-950">¿Eliminar "{{ $row->nombre }}"?</h2>
                            <p class="mt-1 text-sm text-ink-500">Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="px-5 py-4 flex flex-wrap gap-2 justify-end">
                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="{{ url('productos/'.$row->id) }}">
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

            {{-- Modal QR --}}
            <div class="modal fade" id="imagenModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-soft-2 rounded-lg overflow-hidden">
                        <div class="px-5 pt-5">
                            <h2 class="text-lg font-semibold text-ink-950">{{ $row->nombre }}</h2>
                            <p class="mt-1 text-xs font-mono text-ink-500">ID: {{ $row->id }}</p>
                        </div>
                        <div class="px-5 py-4 flex justify-center bg-elevated">
                            <img src="{{ route('producto.qr.svg', $row->id) }}"
                                 alt="Código QR de {{ $row->nombre }}"
                                 class="w-full max-w-xs aspect-square bg-white p-3 rounded-md shadow-soft-1"
                                 loading="lazy">
                        </div>
                        <div class="px-5 py-4 flex flex-wrap gap-2 justify-end">
                            <a href="{{ route('producto.qr.png', $row->id) }}"
                               download="qr-producto-{{ $row->id }}.png"
                               class="btn-secondary">
                                Descargar PNG
                            </a>
                            <button type="button" class="btn-primary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @empty
        <div class="col-span-full">
            <x-empty-state title="Aún no tienes productos"
                           description="Para empezar a gestionar tu inventario, asegúrate de tener al menos un almacén y una categoría, y registra tu primer producto.">
                <a href="{{ url('/crear-producto') }}" class="btn-primary">
                    Crear primer producto
                </a>
            </x-empty-state>
        </div>
    @endforelse
</div>
