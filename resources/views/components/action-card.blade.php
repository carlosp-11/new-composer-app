@props([
    'href',
    'title',
    'description' => null,
    'icon' => null,
    'variant' => 'secondary',
])
@php
    $variants = [
        'primary' => 'bg-brand-600 text-white hover:bg-brand-500 border-transparent',
        'secondary' => 'bg-card text-ink-950 hover:border-brand-500 border-line',
    ];
    $iconStyle = [
        'primary' => 'bg-white/15 text-white',
        'secondary' => 'bg-brand-50 text-brand-600',
    ];
    $captionStyle = [
        'primary' => 'text-white/80',
        'secondary' => 'text-ink-500',
    ];
@endphp

<a href="{{ $href }}"
   class="group flex items-center gap-4 rounded-lg border-2 px-5 py-5 sm:py-6 shadow-soft-1 transition duration-120 ease-out-soft hover:shadow-soft-2 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2 {{ $variants[$variant] }}">
    @if($icon)
        <span class="inline-flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-lg {{ $iconStyle[$variant] }}">
            {!! $icon !!}
        </span>
    @endif
    <div class="flex-1 min-w-0">
        <h3 class="text-base sm:text-lg font-semibold leading-tight">{{ $title }}</h3>
        @if($description)
            <p class="mt-1 text-sm {{ $captionStyle[$variant] }}">{{ $description }}</p>
        @endif
    </div>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 transition-transform duration-120 ease-out-soft group-hover:translate-x-0.5" aria-hidden="true">
        <path d="m9 18 6-6-6-6"/>
    </svg>
</a>
