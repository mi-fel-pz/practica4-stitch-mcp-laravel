{{--
    Botón para cambiar entre "Día Cálido" y "Noche Neón".
    Los textos e iconos de cada modo son configurables; resources/js/ui.js hace el cambio.
--}}
@props([
    'lightIcon' => 'nightlight',
    'darkIcon' => 'light_mode',
    'lightText' => 'Noche Neón',
    'darkText' => 'Día Cálido',
])

<button type="button" data-theme-toggle
    {{ $attributes->class('inline-flex items-center gap-2 whitespace-nowrap font-label-md text-label-md transition-all cursor-pointer') }}>
    <x-ui.icon :name="$lightIcon" size="18" class="text-primary"
        data-theme-icon :data-light="$lightIcon" :data-dark="$darkIcon" />
    <span data-theme-text data-light="{{ $lightText }}" data-dark="{{ $darkText }}">{{ $lightText }}</span>
</button>
