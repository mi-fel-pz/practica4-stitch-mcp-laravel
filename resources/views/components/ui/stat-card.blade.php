{{-- Tarjeta de métrica del catálogo. El contenido (valor y detalle) va en el slot. --}}
@props(['label', 'icon' => null, 'iconClass' => 'bg-surface-container text-primary'])

<div {{ $attributes->class('p-4 rounded-xl bg-surface-container-lowest shadow-sm flex items-center justify-between gap-3') }}>
    <div class="space-y-1 min-w-0">
        <span class="block font-label-sm text-label-sm uppercase tracking-wider text-secondary">{{ $label }}</span>
        {{ $slot }}
    </div>

    @isset($aside)
        {{ $aside }}
    @elseif ($icon)
        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $iconClass }}">
            <x-ui.icon :name="$icon" size="20" />
        </div>
    @endisset
</div>
