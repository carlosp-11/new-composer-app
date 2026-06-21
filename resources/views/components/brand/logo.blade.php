@props([
    'size' => 32,
    'showWordmark' => true,
])
<a href="{{ url('/') }}" class="inline-flex items-center group">
    <img src="{{ asset('img/cdepot_icon.png') }}"
         alt="C-DEPOT"
         width="{{ $size }}"
         height="{{ $size }}"
         style="height: {{ $size }}px; width: auto;">
    @if(!$showWordmark)
        <span class="sr-only">C-DEPOT</span>
    @endif
</a>
