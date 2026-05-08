<div x-data="{ filtro: '' }" class="bg-card rounded-lg border border-line shadow-soft-1 p-3 sm:p-4">
    <div class="flex flex-col sm:flex-row gap-3">
        <form id="searchForm" class="flex-1 flex items-center gap-2">
            <span class="inline-flex items-center justify-center h-11 w-11 shrink-0 text-ink-500" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
            </span>
            <label for="searchInput" class="sr-only">Buscar productos por nombre</label>
            <input type="text" name="q" id="searchInput"
                   class="input flex-1"
                   placeholder="Buscar por nombre…"
                   autocomplete="off">
        </form>

        <div class="flex items-center gap-2 sm:border-l sm:border-line sm:pl-3">
            <label for="filtroSelect" class="sr-only">Filtrar por</label>
            <select id="filtroSelect"
                    class="input w-auto"
                    @change="filtro = $event.target.value; filterRequest(filtro)">
                <option value="">Todo</option>
                <option value="categoria">Por categoría</option>
                <option value="almacen">Por almacén</option>
            </select>

            <label for="termino" class="sr-only">Valor del filtro</label>
            <select id="termino" name="termino"
                    class="input w-auto"
                    x-show="filtro !== ''"
                    x-cloak
                    style="display:none;">
                <option value="">Selecciona…</option>
            </select>

            <button type="button" id="buscarBtn"
                    class="btn-primary btn-sm whitespace-nowrap"
                    x-show="filtro !== ''"
                    x-cloak
                    style="display:none;">
                Filtrar
            </button>
        </div>
    </div>
</div>
