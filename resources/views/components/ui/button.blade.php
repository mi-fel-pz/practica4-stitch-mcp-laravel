{{--
    Botón del sistema de diseño.
    Variantes: primary | secondary | soft | ghost | danger | link
    Tamaños:   xs | sm | md | lg
    Si recibe "href" se pinta como enlace.
--}}
@props(['variant' => 'primary', 'size' => 'md', 'icon' => null, 'iconRight' => null, 'href' => null])

@php
    $variants = [
        'primary' => 'bg-primary text-on-primary hover:bg-primary-container shadow-md',
        'secondary' => 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest',
        'soft' => 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container border border-surface-container',
        'ghost' => 'bg-surface-container-lowest text-on-surface hover:bg-surface-container-highest',
        'danger' => 'bg-error-container text-on-error-container hover:bg-error/20',
        'link' => 'text-primary hover:underline',
    ];
    $sizes = [
        'xs' => 'px-2 py-1 rounded',
        'sm' => 'px-3 py-1.5 rounded-lg',
        'md' => 'px-4 py-2.5 rounded-xl',
        'lg' => 'px-6 py-2.5 rounded-xl',
    ];
    $classes = 'inline-flex items-center justify-center gap-2 font-label-md text-label-md whitespace-nowrap transition-all cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed '
        . ($variant === 'link' ? '' : $sizes[$size]) . ' ' . $variants[$variant];
    $iconSize = in_array($size, ['xs', 'sm']) ? 16 : 18;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if ($icon) <x-ui.icon :name="$icon" :size="$iconSize" /> @endif
        {{ $slot }}
        @if ($iconRight) <x-ui.icon :name="$iconRight" :size="$iconSize" /> @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button'])->class($classes) }}>
        @if ($icon) <x-ui.icon :name="$icon" :size="$iconSize" /> @endif
        {{ $slot }}
        @if ($iconRight) <x-ui.icon :name="$iconRight" :size="$iconSize" /> @endif
    </button>
@endif
