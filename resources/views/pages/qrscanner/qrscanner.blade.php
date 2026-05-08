@extends('layouts.main')

@section('title', 'Escanear QR')

@section('content')
    <section class="max-w-xl mx-auto px-4 sm:px-6 py-6">
        <header class="mb-4 text-center">
            <h1 class="text-xl sm:text-2xl font-semibold text-ink-950">Escanear código QR</h1>
            <p class="mt-1 text-sm text-ink-500">Apunta la cámara al código QR del producto.</p>
        </header>

        <x-card class="overflow-hidden" :padded="false">
            <div class="aspect-video bg-ink-950 flex items-center justify-center">
                <video id="qr-video" class="w-full h-full object-cover" autoplay muted playsinline></video>
            </div>
            <div class="p-4 text-center">
                <p id="cam-qr-result" class="text-sm text-ink-500">Esperando código QR…</p>
                <p id="cam-qr-result-timestamp" class="text-xs text-ink-500/60 mt-1"></p>
            </div>
        </x-card>

        <p class="mt-4 text-xs text-ink-500 text-center">
            Si no funciona la cámara, comprueba los permisos del navegador.
        </p>
    </section>
@endsection

@push('scripts')
<script type="module">
    import QrScanner from '{{ asset('js/qr-scanner.min.js') }}';

    const video = document.getElementById('qr-video');
    const resultLabel = document.getElementById('cam-qr-result');
    const timestampLabel = document.getElementById('cam-qr-result-timestamp');

    const isSafeUrl = (value) => {
        try {
            const url = new URL(value, window.location.origin);
            return ['http:', 'https:'].includes(url.protocol);
        } catch {
            return false;
        }
    };

    function setResult(result) {
        if (!result || !result.data) {
            resultLabel.textContent = 'No se detecta código QR';
            return;
        }
        if (!isSafeUrl(result.data)) {
            resultLabel.textContent = 'Código QR no válido';
            return;
        }
        resultLabel.textContent = '';
        const a = document.createElement('a');
        a.href = result.data;
        a.target = '_blank';
        a.rel = 'noopener';
        a.className = 'text-brand-600 font-medium';
        a.textContent = 'Abrir producto escaneado';
        resultLabel.appendChild(a);
        timestampLabel.textContent = new Date().toLocaleString();
    }

    const scanner = new QrScanner(video, setResult, {
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    scanner.start().catch(() => {
        resultLabel.textContent = 'No hemos podido acceder a la cámara. Comprueba los permisos.';
    });
</script>
@endpush
