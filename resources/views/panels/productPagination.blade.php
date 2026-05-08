@if($productos->hasPages())
    <nav id="pagination-container" aria-label="Paginación de productos" class="flex items-center justify-center gap-1">
        @if($productos->onFirstPage())
            <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed" aria-disabled="true">Anterior</span>
        @else
            <a href="{{ $productos->previousPageUrl() }}"
               class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2">
                Anterior
            </a>
        @endif

        @foreach($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
            @if($page === $productos->currentPage())
                <span class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm font-medium bg-brand-600 text-white tabular-nums" aria-current="page">{{ $page }}</span>
            @else
                <a href="{{ $url }}"
                   class="inline-flex items-center justify-center h-9 min-w-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated tabular-nums focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        @if($productos->currentPage() === $productos->lastPage())
            <span class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-500 bg-elevated cursor-not-allowed" aria-disabled="true">Siguiente</span>
        @else
            <a href="{{ $productos->nextPageUrl() }}"
               class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm text-ink-700 hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2">
                Siguiente
            </a>
        @endif
    </nav>
@else
    <div id="pagination-container"></div>
@endif
