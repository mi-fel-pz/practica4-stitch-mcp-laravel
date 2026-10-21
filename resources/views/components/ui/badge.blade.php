{{--
    Píldora de estado o etiqueta.
    Tonos: success | mint | primary | secondary | neutral | muted | pending | danger | solid
--}}
@props(['tone' => 'neutral', 'dot' => false, 'pulse' => false, 'pill' => true])

@php
    $tones = [
        'success' => ['bg-surface-container text-tertiary', 'bg-tertiary-fixed-dim'],
        'mint' => ['bg-tertiary-fixed-dim/30 text-tertiary', 'bg-tertiary'],
        'primary' => ['bg-primary-fixed text-on-primary-fixed', 'bg-primary'],
        'secondary' => ['bg-secondary-fixed text-on-secondary-fixed', 'bg-secondary'],
        'neutral' => ['bg-surface-container-high text-on-surface-variant', 'bg-secondary'],
        'muted' => ['bg-surface-container-highest text-on-surface-variant', 'bg-secondary'],
        'pending' => ['bg-surface-container-highest text-on-surface-variant', 'bg-secondary'],
        'danger' => ['bg-error-container text-on-error-container', 'bg-error'],
        'solid' => ['bg-primary text-on-primary', 'bg-on-primary'],
    ];
    [$colors, $dotColor] = $tones[$tone] ?? $tones['neutral'];
@endphp

<span {{ $attributes->class([
    'inline-flex items-center gap-1.5 px-2.5 py-0.5 font-label-sm text-label-sm whitespace-nowrap',
    $pill ? 'rounded-full' : 'rounded',
    $colors,
]) }}>
    @if ($dot)
        <span @class(['w-1.5 h-1.5 rounded-full', $dotColor, 'animate-pulse' => $pulse])></span>
    @endif
    {{ $slot }}
</span>
