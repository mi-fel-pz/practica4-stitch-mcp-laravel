{{--
    Lista desplegable. "options" es un arreglo valor => texto.
    Uso: <x-ui.select name="sucursal" label="Sucursal" :options="$sedes" :selected="$perfil['sucursal']" />
--}}
@props([
    'name',
    'options' => [],
    'label' => null,
    'selected' => null,
    'size' => 'md',
    'icon' => 'expand_more',
    'id' => null,
])

@php
    $id = $id ?? $name;
    $current = (string) old($name, $selected);
    $classes = $size === 'sm'
        ? 'pl-3 pr-8 py-1.5 font-body-sm text-body-sm bg-surface-container-lowest shadow-sm border-transparent'
        : 'px-4 pr-10 py-2.5 font-body-md text-body-md bg-surface-container-low border-surface-container focus:bg-surface-container-lowest focus:ring-1 focus:ring-primary';
@endphp

<div {{ $attributes->only('class')->class('space-y-1.5') }}>
    @if ($label)
        <label for="{{ $id }}" class="block font-label-md text-label-md text-on-surface">{{ $label }}</label>
    @endif

    <div class="relative">
        <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->except('class') }}
            @class([
                "w-full appearance-none rounded-xl border text-on-surface cursor-pointer focus:outline-none transition-all $classes",
                'border-error! ring-1 ring-error' => $errors->has($name),
            ])>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" @selected($current === (string) $value)>{{ $text }}</option>
            @endforeach
        </select>
        <x-ui.icon :name="$icon" :size="$size === 'sm' ? 16 : 18"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary pointer-events-none" />
    </div>

    @error($name)
        <p class="font-label-sm text-label-sm text-error">{{ $message }}</p>
    @enderror
</div>
