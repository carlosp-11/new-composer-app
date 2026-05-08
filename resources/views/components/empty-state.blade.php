@props([
    'title',
    'description' => null,
    'icon' => 'package',
])
<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center py-12 px-4']) }}>
    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-elevated text-ink-500">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16.5 9.4 7.55 4.24"/>
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            <path d="M3.27 6.96 12 12.01l8.73-5.05"/>
            <path d="M12 22.08V12"/>
        </svg>
    </div>
    <h3 class="text-base font-semibold text-ink-950">{{ $title }}</h3>
    @if($description)
        <p class="mt-1 text-sm text-ink-500 max-w-md">{{ $description }}</p>
    @endif
    @if(trim($slot))
        <div class="mt-5 flex flex-wrap gap-2 justify-center">
            {{ $slot }}
        </div>
    @endif
</div>
