{{--
    Campo de texto con etiqueta, icono opcional, estado de solo lectura y errores de validación.
    El valor usa old() para conservar lo escrito si la validación falla.
    Slot opcional "badge": se muestra a la derecha de la etiqueta.
--}}
@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'icon' => null,
    'readonly' => false,
    'lock' => false,
    'hint' => null,
    'size' => 'md',
    'mono' => false,
    'id' => null,
])

@php
    $id = $id ?? str_replace(['[', ']', '.'], ['-', '', '-'], $name);
    $errorKey = str_replace(['[', ']'], ['.', ''], $name);
    $text = $mono ? 'font-code-sm text-code-sm' : ($size === 'sm' ? 'font-body-sm text-body-sm' : 'font-body-md text-body-md');
    $padY = $size === 'sm' ? 'py-2' : 'py-2.5';
    $padL = $icon ? 'pl-10' : ($size === 'sm' ? 'pl-3.5' : 'pl-4');
    $padR = $lock ? 'pr-10' : ($size === 'sm' ? 'pr-3.5' : 'pr-4');
    $state = $readonly
        ? 'bg-surface-container text-on-surface-variant border-transparent cursor-not-allowed'
        : 'bg-surface-container-low text-on-surface border-surface-container focus:bg-surface-container-lowest focus:ring-1 focus:ring-primary';
    $current = $type === 'password' ? null : old($errorKey, $value);
@endphp

<div {{ $attributes->only('class')->class('space-y-1.5') }}>
    @if ($label)
        <label for="{{ $id }}" @class([
            'flex items-center justify-between gap-2',
            'font-label-md text-label-md text-on-surface' => $size === 'md',
            'font-label-sm text-label-sm text-secondary' => $size === 'sm',
        ])>
            <span>{{ $label }}</span>
            {{ $badge ?? '' }}
        </label>
    @endif

    <div class="relative">
        @if ($icon)
            <x-ui.icon :name="$icon" size="18" class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary pointer-events-none" />
        @endif

        <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}"
            @if (! is_null($current)) value="{{ $current }}" @endif
            @readonly($readonly)
            {{ $attributes->except('class') }}
            @class([
                "w-full rounded-xl border focus:outline-none transition-all placeholder:text-secondary/70 $text $padY $padL $padR $state",
                'border-error! ring-1 ring-error' => $errors->has($errorKey),
            ])>

        @if ($lock)
            <x-ui.icon name="lock" size="18" class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary pointer-events-none" />
        @endif
    </div>

    @if ($hint)
        <p class="font-label-sm text-label-sm text-secondary">{{ $hint }}</p>
    @endif

    @error($errorKey)
        <p class="font-label-sm text-label-sm text-error flex items-center gap-1">
            <x-ui.icon name="error" size="14" /> {{ $message }}
        </p>
    @enderror
</div>
