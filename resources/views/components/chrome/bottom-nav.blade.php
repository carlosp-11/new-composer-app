@php
    $user = auth()->user();
    $isAdmin = $user?->isAdmin();
    $current = request()->path();

    $items = collect();
    $items->push([
        'href' => url('/'),
        'label' => 'Inicio',
        'active' => $current === '/',
        'icon' => 'home',
    ]);
    $items->push([
        'href' => url('/productos'),
        'label' => 'Productos',
        'active' => str_starts_with($current, 'productos'),
        'icon' => 'box',
    ]);
    $items->push([
        'href' => url('/qrscanner'),
        'label' => 'Escanear',
        'active' => $current === 'qrscanner',
        'icon' => 'qr',
        'primary' => true,
    ]);
    if ($isAdmin) {
        $items->push([
            'href' => url('/almacenes'),
            'label' => 'Almacenes',
            'active' => str_starts_with($current, 'almacenes'),
            'icon' => 'warehouse',
        ]);
    } else {
        $items->push([
            'href' => url('/private'),
            'label' => 'Cuenta',
            'active' => $current === 'private',
            'icon' => 'user',
        ]);
    }

    $icons = [
        'home' => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4a2 2 0 0 0-2-2 2 2 0 0 0-2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>',
        'box' => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><path d="M3.27 6.96 12 12.01l8.73-5.05"/><path d="M12 22.08V12"/>',
        'qr' => '<rect width="6" height="6" x="3" y="3" rx="1"/><rect width="6" height="6" x="15" y="3" rx="1"/><rect width="6" height="6" x="3" y="15" rx="1"/><path d="M21 21v.01"/><path d="M15 15h.01"/><path d="M21 15h-2"/><path d="M15 18v3"/><path d="M21 18h-3v3"/>',
        'warehouse' => '<path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/>',
        'user' => '<circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 0 0-16 0"/>',
    ];
@endphp

<nav class="md:hidden fixed bottom-0 inset-x-0 z-30 bg-card border-t border-line"
     style="padding-bottom: env(safe-area-inset-bottom);"
     aria-label="Acciones rápidas">
    <ul class="flex items-stretch justify-around h-16">
        @foreach($items as $item)
            <li class="flex-1 max-w-[25%]">
                <a href="{{ $item['href'] }}"
                   class="flex flex-col items-center justify-center h-full gap-0.5 text-[11px] {{ $item['active'] ? 'text-brand-600' : 'text-ink-500 hover:text-ink-700' }}"
                   @if($item['active']) aria-current="page" @endif>
                    @if(isset($item['primary']) && $item['primary'])
                        <span class="-mt-3 inline-flex items-center justify-center h-12 w-12 rounded-full bg-brand-600 text-white shadow-soft-2">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                {!! $icons[$item['icon']] !!}
                            </svg>
                        </span>
                    @else
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {!! $icons[$item['icon']] !!}
                        </svg>
                    @endif
                    <span>{{ $item['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
