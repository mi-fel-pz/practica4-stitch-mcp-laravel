{{-- Icono de Material Symbols. Uso: <x-ui.icon name="search" size="18" class="text-secondary" /> --}}
@props(['name', 'size' => 20, 'filled' => false])

<span {{ $attributes->class('material-symbols-outlined inline-block shrink-0') }}
    style="font-size: {{ $size }}px; @if ($filled) font-variation-settings: 'FILL' 1; @endif"
    aria-hidden="true">{{ $name }}</span>
