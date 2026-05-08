@extends('layouts.main')

@section('title', 'Mi cuenta')

@section('content')
<section class="px-4 sm:px-6 py-6 max-w-3xl mx-auto space-y-5">
    <header>
        <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950 tracking-tight">Mi cuenta</h1>
        <p class="mt-1 text-sm text-ink-500">Datos personales y resumen de tu actividad.</p>
    </header>

    <x-card>
        <h2 class="text-base font-semibold text-ink-950 mb-4">Datos de la cuenta</h2>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <dt class="text-xs font-medium text-ink-500 uppercase tracking-wide">Correo electrónico</dt>
                <dd class="mt-1 text-ink-950 break-all">{{ $correoElectronico }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-ink-500 uppercase tracking-wide">Rol</dt>
                <dd class="mt-1">
                    <span class="chip">{{ auth()->user()?->isAdmin() ? 'Administrador' : 'Operario' }}</span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-xs font-medium text-ink-500 uppercase tracking-wide">Cuenta creada</dt>
                <dd class="mt-1 text-ink-950 tabular-nums">{{ $fechaCreacion }}</dd>
            </div>
        </dl>
    </x-card>

    @admin
        <x-card>
            <h2 class="text-base font-semibold text-ink-950 mb-4">Resumen</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center">
                    <p class="text-2xl sm:text-3xl font-semibold text-ink-950 tabular-nums">{{ $numeroAlmacenes }}</p>
                    <p class="mt-1 text-xs text-ink-500 uppercase tracking-wide">Almacenes</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl sm:text-3xl font-semibold text-ink-950 tabular-nums">{{ $numeroCategorias }}</p>
                    <p class="mt-1 text-xs text-ink-500 uppercase tracking-wide">Categorías</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl sm:text-3xl font-semibold text-ink-950 tabular-nums">{{ $numeroProductos }}</p>
                    <p class="mt-1 text-xs text-ink-500 uppercase tracking-wide">Productos</p>
                </div>
            </div>
        </x-card>
    @endadmin

    <x-card>
        <h2 class="text-base font-semibold text-ink-950 mb-4">Acciones</h2>
        <div class="space-y-3">
            <form method="POST" action="{{ route('enviar-bienvenida') }}" class="flex flex-wrap items-center justify-between gap-3">
                @csrf
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-ink-950">Reenviar email de bienvenida</p>
                    <p class="text-xs text-ink-500">Te enviaremos los pasos básicos para empezar.</p>
                </div>
                <button type="submit" class="btn-secondary btn-sm">Enviar</button>
            </form>

            <div class="border-t border-line pt-3 flex flex-wrap items-center justify-between gap-3">
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-ink-950">Cerrar sesión</p>
                    <p class="text-xs text-ink-500">Tendrás que volver a iniciar sesión para acceder.</p>
                </div>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary btn-sm">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </x-card>
</section>
@endsection
