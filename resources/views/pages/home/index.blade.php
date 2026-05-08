@extends('layouts.main')

@section('title', 'Inicio')

@section('content')
<section class="px-4 sm:px-6 py-6 sm:py-10 max-w-6xl mx-auto">
    @php
        $hour = (int) now()->setTimezone(config('app.timezone', 'UTC'))->format('H');
        $greeting = $hour < 6 ? 'Buenas noches' : ($hour < 13 ? 'Buenos días' : ($hour < 21 ? 'Buenas tardes' : 'Buenas noches'));
        $name = $user?->name && strtolower($user->name) !== 'usuario' ? $user->name : strtok($user?->email ?? '', '@');
    @endphp

    <header class="mb-6 sm:mb-8">
        <p class="text-sm text-ink-500">{{ $greeting }},</p>
        <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">{{ ucfirst($name) }}</h1>
        @admin
            <p class="mt-1 text-sm text-ink-500">Resumen de tu depósito.</p>
        @else
            <p class="mt-1 text-sm text-ink-500">¿Qué vas a hacer hoy?</p>
        @endadmin
    </header>

    @admin
        {{-- Dashboard administrador --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="lg:col-span-2 space-y-5">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                    <x-stat-card
                        :href="url('/almacenes')"
                        label="Almacenes"
                        :value="$stats['almacenes']"
                        :icon="'<svg width=\'20\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z\'/><path d=\'M6 18h12\'/><path d=\'M6 14h12\'/><rect width=\'12\' height=\'12\' x=\'6\' y=\'10\'/></svg>'"
                    />
                    <x-stat-card
                        :href="url('/categorias')"
                        label="Categorías"
                        :value="$stats['categorias']"
                        :icon="'<svg width=\'20\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M3 7.8a2 2 0 0 1 .6-1.4l3.4-3.4a2 2 0 0 1 1.4-.6h6.8a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 0 2.8L12 19l-9-9.2z\'/><path d=\'M14 7h.01\'/></svg>'"
                    />
                    <x-stat-card
                        :href="url('/productos')"
                        label="Productos"
                        :value="$stats['productos']"
                        :icon="'<svg width=\'20\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\'/><path d=\'M3.27 6.96 12 12.01l8.73-5.05\'/><path d=\'M12 22.08V12\'/></svg>'"
                    />
                    <x-stat-card
                        label="Incidencias"
                        :value="$stats['incidencias']"
                        :tone="$stats['incidencias'] > 0 ? 'warn' : 'neutral'"
                        :caption="$stats['incidencias'] > 0 ? 'Productos a revisar' : 'Sin novedades'"
                        :icon="'<svg width=\'20\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M12 9v4\'/><path d=\'M12 17h.01\'/><path d=\'M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z\'/></svg>'"
                    />
                </div>

                <div class="grid sm:grid-cols-2 gap-3 sm:gap-4">
                    <x-action-card
                        variant="primary"
                        :href="url('/qrscanner')"
                        title="Escanear código QR"
                        description="Identifica un producto al instante."
                        :icon="'<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><rect width=\'6\' height=\'6\' x=\'3\' y=\'3\' rx=\'1\'/><rect width=\'6\' height=\'6\' x=\'15\' y=\'3\' rx=\'1\'/><rect width=\'6\' height=\'6\' x=\'3\' y=\'15\' rx=\'1\'/><path d=\'M21 21v.01\'/><path d=\'M15 15h.01\'/><path d=\'M21 15h-2\'/><path d=\'M15 18v3\'/><path d=\'M21 18h-3v3\'/></svg>'"
                    />
                    <x-action-card
                        :href="url('/crear-producto')"
                        title="Registrar producto"
                        description="Da de alta un nuevo artículo."
                        :icon="'<svg width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M12 5v14\'/><path d=\'M5 12h14\'/></svg>'"
                    />
                </div>
            </div>

            <aside class="space-y-5 lg:col-span-1">
                <x-onboarding-checklist :progress="$onboarding" />
            </aside>
        </div>
    @else
        {{-- Dashboard operario: 3 acciones grandes --}}
        <div class="space-y-3 sm:space-y-4 max-w-2xl mx-auto">
            <x-action-card
                variant="primary"
                :href="url('/crear-producto')"
                title="Registrar producto"
                description="Foto, datos y código QR en un minuto."
                :icon="'<svg width=\'28\' height=\'28\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z\'/><circle cx=\'12\' cy=\'13\' r=\'3\'/></svg>'"
            />
            <x-action-card
                :href="url('/qrscanner')"
                title="Escanear código QR"
                description="Apunta y consulta la ficha al instante."
                :icon="'<svg width=\'28\' height=\'28\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><rect width=\'6\' height=\'6\' x=\'3\' y=\'3\' rx=\'1\'/><rect width=\'6\' height=\'6\' x=\'15\' y=\'3\' rx=\'1\'/><rect width=\'6\' height=\'6\' x=\'3\' y=\'15\' rx=\'1\'/><path d=\'M21 21v.01\'/><path d=\'M15 15h.01\'/><path d=\'M21 15h-2\'/><path d=\'M15 18v3\'/><path d=\'M21 18h-3v3\'/></svg>'"
            />
            <x-action-card
                :href="url('/productos')"
                title="Ver mis productos"
                description="Listado de los artículos del almacén."
                :icon="'<svg width=\'28\' height=\'28\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z\'/><path d=\'M3.27 6.96 12 12.01l8.73-5.05\'/><path d=\'M12 22.08V12\'/></svg>'"
            />
        </div>
    @endadmin
</section>
@endsection
