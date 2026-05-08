@props([
    'size' => 32,
    'showWordmark' => true,
])
<a href="{{ url('/') }}" class="inline-flex items-center gap-2 group">
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect x="2" y="2" width="28" height="28" rx="7" fill="currentColor" class="text-brand-600"/>
        <path d="M21 11a6 6 0 1 0 0 10" stroke="white" stroke-width="2.4" stroke-linecap="round" fill="none"/>
        <circle cx="22" cy="16" r="1.6" fill="white"/>
    </svg>
    @if($showWordmark)
        <span class="font-semibold tracking-tight text-ink-950 text-base sm:text-lg">
            C-DEPOT
        </span>
    @endif
</a>
