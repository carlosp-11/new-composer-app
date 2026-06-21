@extends('layouts.home')

@section('title', $modo === 'login' ? 'Iniciar sesión' : 'Crear cuenta')

@section('content')
<section class="w-full max-w-md">
    <header class="text-center mb-6">
        <div class="flex items-center justify-center gap-3 mb-4">
            <img src="{{ asset('img/cd_icon.png') }}" alt="C" style="height: 4rem; width: auto;">
            <img src="{{ asset('img/depot_letter.png') }}" alt="DEPOT" style="height: 2.25rem; width: auto;">
        </div>
        <h1 class="text-2xl sm:text-3xl font-semibold text-ink-950">
            {{ $modo === 'login' ? 'Iniciar sesión' : 'Crear cuenta' }}
        </h1>
        <p class="mt-2 text-sm text-ink-500">
            {{ $modo === 'login'
                ? 'Accede a tus almacenes, productos y códigos QR.'
                : 'Crea tu cuenta para empezar a gestionar tu almacén.' }}
        </p>
    </header>

    <x-card>
        <form action="{{ $modo === 'login' ? url('/login') : url('/signup') }}" method="POST" class="space-y-4" id="formulario">
            @csrf

            <div>
                <label class="label" for="email">Correo electrónico</label>
                <input type="email" class="input" id="email" name="email"
                       placeholder="tu@empresa.com"
                       autocomplete="email" required value="{{ old('email') }}">
            </div>

            <div>
                <label class="label" for="password">Contraseña</label>
                <input type="password" class="input" id="password" name="password"
                       autocomplete="{{ $modo === 'login' ? 'current-password' : 'new-password' }}" required>
                @if($modo !== 'login')
                    <p class="mt-1.5 text-xs text-ink-500">
                        Mínimo 8 caracteres, sin espacios. Puedes usar letras, números y símbolos.
                    </p>
                @endif
            </div>

            <button type="submit" class="btn-primary btn-lg w-full">
                {{ $modo === 'login' ? 'Iniciar sesión' : 'Crear cuenta' }}
            </button>
        </form>
    </x-card>

    <p class="mt-5 text-center text-sm text-ink-500">
        @if($modo === 'login')
            ¿Aún no tienes cuenta?
            <a href="{{ url('/signup') }}" class="font-medium text-brand-600 hover:underline">Crear cuenta</a>
        @else
            ¿Ya tienes cuenta?
            <a href="{{ url('/login') }}" class="font-medium text-brand-600 hover:underline">Iniciar sesión</a>
        @endif
    </p>
</section>
@endsection
