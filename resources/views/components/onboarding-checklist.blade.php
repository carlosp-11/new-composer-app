@props([
    'progress',
])
@php
    $steps = [
        [
            'key' => 'almacen',
            'label' => 'Crear tu primer almacén',
            'description' => 'Define dónde guardas los productos.',
            'href' => url('/crear-almacen'),
            'cta' => 'Crear almacén',
            'done' => $progress['almacen'] ?? false,
        ],
        [
            'key' => 'categoria',
            'label' => 'Crear una categoría',
            'description' => 'Agrupa productos para encontrarlos fácil.',
            'href' => url('/crear-categoria'),
            'cta' => 'Crear categoría',
            'done' => $progress['categoria'] ?? false,
        ],
        [
            'key' => 'producto',
            'label' => 'Registrar tu primer producto',
            'description' => 'Lo daremos de alta con su código QR.',
            'href' => url('/crear-producto'),
            'cta' => 'Crear producto',
            'done' => $progress['producto'] ?? false,
        ],
    ];
    $done = $progress['done'] ?? 0;
    $total = $progress['total'] ?? count($steps);
    $pct = $total > 0 ? (int) round(($done / $total) * 100) : 0;
    $allDone = $done === $total;
@endphp

@if(!$allDone)
    <section x-data="{ open: true }" class="bg-card rounded-lg border border-line shadow-soft-1 overflow-hidden">
        <header class="flex items-center justify-between gap-3 px-4 py-3 border-b border-line">
            <div class="min-w-0">
                <h2 class="text-sm font-semibold text-ink-950">Primeros pasos</h2>
                <p class="text-xs text-ink-500 mt-0.5"><span class="tabular-nums">{{ $done }}/{{ $total }}</span> · {{ $pct }}% listo</p>
            </div>
            <button type="button"
                    class="inline-flex items-center justify-center h-8 w-8 rounded-md text-ink-500 hover:bg-elevated focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2"
                    @click="open = !open"
                    :aria-expanded="open"
                    aria-label="Mostrar u ocultar los primeros pasos">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" :class="{'rotate-180': !open}" class="transition-transform duration-120 ease-out-soft" aria-hidden="true">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
        </header>

        <div class="h-1 bg-elevated">
            <div class="h-full bg-brand-600 transition-all duration-120 ease-out-soft" style="width: {{ $pct }}%"></div>
        </div>

        <ul x-show="open" x-collapse class="divide-y divide-line">
            @foreach($steps as $step)
                <li class="px-4 py-3 flex items-start gap-3">
                    @if($step['done'])
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-50 text-brand-600 mt-0.5" aria-label="Completado">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    @else
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-line mt-0.5" aria-label="Pendiente"></span>
                    @endif
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium {{ $step['done'] ? 'text-ink-500 line-through' : 'text-ink-950' }}">
                            {{ $step['label'] }}
                        </p>
                        @unless($step['done'])
                            <p class="text-xs text-ink-500 mt-0.5">{{ $step['description'] }}</p>
                            <a href="{{ $step['href'] }}" class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-brand-600 hover:underline">
                                {{ $step['cta'] }}
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        @endunless
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endif
