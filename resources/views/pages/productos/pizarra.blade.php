@extends('layouts.main')

@section('title', 'Productos')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-7xl mx-auto space-y-5">
    <header class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">Productos</h1>
            <p class="mt-1 text-sm text-ink-500">Tu inventario completo, listo para escanear o actualizar.</p>
        </div>
        <a href="{{ url('/crear-producto') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14"/><path d="M5 12h14"/>
            </svg>
            Crear producto
        </a>
    </header>

    @include('panels.productFilter')

    @include('panels.productTable', [
        'productos' => $productos,
        'categorias' => $categorias,
        'almacenes' => $almacenes,
        'productosCategorias' => $productosCategorias,
        'imagenes' => $imagenes ?? collect(),
    ])

    @include('panels.productPagination')
</section>
@endsection

@push('scripts')
<script>
(() => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    const filtroSelect = document.getElementById('filtroSelect');
    const terminoSelect = document.getElementById('termino');
    const buscarBtn = document.getElementById('buscarBtn');
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    const categorias = @json($categorias->map(fn ($c) => ['id' => $c->id, 'nombre' => $c->nombre])->values());
    const almacenes = @json($almacenes->map(fn ($a) => ['id' => $a->id, 'nombre' => $a->nombre])->values());

    const populateTerminos = (filtro) => {
        terminoSelect.innerHTML = '';
        const sin = document.createElement('option');
        sin.value = 'null';
        sin.textContent = filtro === 'categoria' ? 'Sin categoría' : 'Sin almacén';
        terminoSelect.appendChild(sin);

        const list = filtro === 'categoria' ? categorias : almacenes;
        list.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.id;
            opt.textContent = item.nombre;
            terminoSelect.appendChild(opt);
        });
    };

    window.filterRequest = (filtro) => {
        if (!filtro) {
            doFetch({ termino: '' });
            return;
        }
        populateTerminos(filtro);
    };

    const doFetch = async (payload) => {
        const data = new FormData();
        data.append('_token', csrf);
        Object.entries(payload).forEach(([k, v]) => data.append(k, v ?? ''));

        try {
            const res = await fetch('{{ url('/productos') }}', {
                method: 'POST',
                body: data,
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const json = await res.json();
            const lista = document.getElementById('lista-productos');
            const pag = document.getElementById('pagination-container');
            if (lista) lista.outerHTML = json.productosHtml;
            if (pag) pag.outerHTML = json.productosPaginationHtml;
        } catch (err) {
            console.error('Error filtrando productos', err);
        }
    };

    searchForm?.addEventListener('submit', (e) => {
        e.preventDefault();
        doFetch({ filtro: '', termino: searchInput.value });
    });

    buscarBtn?.addEventListener('click', () => {
        const filtro = filtroSelect.value;
        const termino = terminoSelect.value;
        doFetch({ filtro, termino });
    });
})();
</script>
@endpush
