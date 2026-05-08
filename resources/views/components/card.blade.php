@props([
    'hover' => false,
    'padded' => true,
])
<div {{ $attributes->merge(['class' => trim('bg-card rounded-lg border border-line shadow-soft-1 transition duration-120 ease-out-soft '.($hover ? 'hover:shadow-soft-2 hover:-translate-y-0.5' : '').' '.($padded ? 'p-4 sm:p-5' : ''))]) }}>
    {{ $slot }}
</div>
