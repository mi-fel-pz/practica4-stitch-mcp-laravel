{{--
    Tarjeta de sección con encabezado (punto de color, título, descripción e icono).
    Uso: <x-ui.card title="1. Información Personal" description="..." icon="badge" dot="bg-primary"> ... </x-ui.card>
--}}
@props(['title' => null, 'description' => null, 'icon' => null, 'dot' => null, 'heading' => 'h2'])

<section {{ $attributes->class('bg-surface-container-lowest rounded-2xl p-7 shadow-sm space-y-6') }}>
    @if ($title)
        <div class="flex items-start justify-between gap-4">
            <div class="space-y-0.5">
                <div class="flex items-center gap-2">
                    @if ($dot)
                        <span class="w-2.5 h-2.5 rounded-full {{ $dot }}"></span>
                    @endif
                    <{{ $heading }} class="font-headline-sm text-headline-sm text-on-surface">{{ $title }}</{{ $heading }}>
                </div>
                @if ($description)
                    <p @class(['font-body-sm text-body-sm text-secondary', 'pl-4.5' => $dot])>{{ $description }}</p>
                @endif
            </div>
            @if ($icon)
                <x-ui.icon :name="$icon" size="22" class="text-secondary" />
            @endif
        </div>
    @endif

    {{ $slot }}
</section>
