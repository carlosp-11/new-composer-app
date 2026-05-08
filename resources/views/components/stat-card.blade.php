@props([
    'href' => null,
    'label',
    'value',
    'caption' => null,
    'tone' => 'neutral',
    'icon' => null,
])
@php
    $toneClasses = [
        'neutral' => 'text-ink-700',
        'success' => 'text-success',
        'warn' => 'text-warn',
        'danger' => 'text-danger',
    ][$tone] ?? 'text-ink-700';

    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    class="group bg-card rounded-lg border border-line shadow-soft-1 p-4 sm:p-5 transition duration-120 ease-out-soft @if($href) hover:shadow-soft-2 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600 focus-visible:ring-offset-2 @endif">
    <div class="flex items-start justify-between gap-3">
        <div class="min-w-0">
            <p class="text-xs font-medium text-ink-500 uppercase tracking-wide">{{ $label }}</p>
            <p class="mt-1 text-2xl sm:text-3xl font-semibold {{ $toneClasses }} tabular-nums">{{ $value }}</p>
            @if($caption)
                <p class="mt-1 text-xs text-ink-500">{{ $caption }}</p>
            @endif
        </div>
        @if($icon)
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-brand-50 text-brand-600 shrink-0">
                {!! $icon !!}
            </span>
        @endif
    </div>
</{{ $tag }}>
