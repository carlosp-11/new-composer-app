@php
    $user = auth()->user();
    $isAdmin = $user?->isAdmin();
    $current = request()->path();
@endphp
<header class="sticky top-0 z-30 bg-card/90 backdrop-blur border-b border-line">
    <div class="flex items-center gap-3 h-14 px-4 sm:px-6">
        <x-brand.logo :size="28" />

        <nav class="hidden md:flex items-center gap-1 ml-6" aria-label="Principal">
            <a href="{{ url('/') }}"
               class="px-3 h-9 inline-flex items-center rounded-md text-sm font-medium {{ $current === '/' ? 'bg-brand-50 text-brand-600' : 'text-ink-700 hover:bg-elevated' }}">
                Inicio
            </a>
            <a href="{{ url('/productos') }}"
               class="px-3 h-9 inline-flex items-center rounded-md text-sm font-medium {{ str_starts_with($current, 'productos') || str_starts_with($current, 'crear-producto') ? 'bg-brand-50 text-brand-600' : 'text-ink-700 hover:bg-elevated' }}">
                Productos
            </a>
            @if($isAdmin)
                <a href="{{ url('/almacenes') }}"
                   class="px-3 h-9 inline-flex items-center rounded-md text-sm font-medium {{ str_starts_with($current, 'almacenes') || str_starts_with($current, 'crear-almacen') ? 'bg-brand-50 text-brand-600' : 'text-ink-700 hover:bg-elevated' }}">
                    Almacenes
                </a>
                <a href="{{ url('/categorias') }}"
                   class="px-3 h-9 inline-flex items-center rounded-md text-sm font-medium {{ str_starts_with($current, 'categorias') || str_starts_with($current, 'crear-categoria') ? 'bg-brand-50 text-brand-600' : 'text-ink-700 hover:bg-elevated' }}">
                    Categorías
                </a>
            @endif
            <a href="{{ url('/qrscanner') }}"
               class="px-3 h-9 inline-flex items-center rounded-md text-sm font-medium {{ $current === 'qrscanner' ? 'bg-brand-50 text-brand-600' : 'text-ink-700 hover:bg-elevated' }}">
                Escanear QR
            </a>
        </nav>

        <div class="ml-auto flex items-center gap-2" x-data="{ open: false }">
            <span class="hidden sm:inline-flex chip" title="Rol del usuario">
                {{ $isAdmin ? 'Administrador' : 'Operario' }}
            </span>
            <button type="button"
                    class="inline-flex items-center gap-2 h-10 px-2.5 rounded-md hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2"
                    @click="open = !open"
                    :aria-expanded="open"
                    aria-haspopup="true">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-600 text-sm font-semibold">
                    {{ strtoupper(substr($user?->email ?? '?', 0, 1)) }}
                </span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
            <div x-show="open"
                 x-transition.opacity.duration.150ms
                 @click.outside="open = false"
                 class="absolute right-4 top-12 w-56 rounded-md bg-card border border-line shadow-soft-2 py-1.5"
                 style="display:none;"
                 role="menu">
                <div class="px-3 py-2 border-b border-line">
                    <p class="text-xs text-ink-500">Sesión iniciada</p>
                    <p class="text-sm font-medium text-ink-950 truncate">{{ $user?->email }}</p>
                </div>
                <a href="{{ url('/private') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-ink-700 hover:bg-elevated" role="menuitem">
                    Mi cuenta
                </a>
                <form method="POST" action="{{ url('/logout') }}" role="none">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 text-sm text-danger hover:bg-red-50" role="menuitem">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
