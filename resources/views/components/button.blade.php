@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'icon' => null,
    'iconOnly' => false,
])

@php
    $variants = [
        'primary' => 'bg-brand-600 text-white hover:bg-brand-500',
        'secondary' => 'bg-card text-ink-700 border border-line hover:bg-elevated',
        'ghost' => 'bg-transparent text-ink-700 hover:bg-brand-50',
        'danger' => 'bg-card text-danger border border-line hover:bg-red-50',
        'danger-solid' => 'bg-danger text-white hover:opacity-90',
    ];
    $sizes = [
        'sm' => 'h-9 px-3 text-xs',
        'md' => 'h-11 px-4 text-sm',
        'lg' => 'h-12 px-6 text-base',
    ];
    $iconOnlySizes = [
        'sm' => 'h-9 w-9',
        'md' => 'h-11 w-11',
        'lg' => 'h-12 w-12',
    ];
    $base = 'inline-flex items-center justify-center gap-2 rounded-md font-medium transition duration-120 ease-out-soft focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    $classes = $base.' '.$variants[$variant].' '.($iconOnly ? $iconOnlySizes[$size] : $sizes[$size]);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif
