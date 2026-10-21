{{-- Panel secundario (240px) --}}
@php
    $grupos = [
        'Usuarios' => [
            ['icon' => 'list', 'label' => 'Listado de usuarios', 'url' => route('usuarios.index'), 'active' => request()->routeIs('usuarios.index')],
            ['icon' => 'person_add', 'label' => 'Registrar usuario', 'url' => route('usuarios.registro'), 'active' => request()->routeIs('usuarios.registro')],
        ],
        'Proyecto' => [
            ['icon' => 'waving_hand', 'label' => 'Saludo (Práctica 3)', 'url' => url('/saludo'), 'active' => request()->is('saludo')],
            ['icon' => 'home', 'label' => 'Inicio de Laravel', 'url' => url('/'), 'active' => false],
        ],
    ];
@endphp

<aside class="fixed left-[76px] top-0 bottom-0 w-[240px] bg-surface-container-low shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex flex-col py-4 transition-colors duration-300">
    <div class="px-4 pb-3">
        <div class="bg-surface-container-lowest p-2.5 rounded-xl shadow-[0_1px_3px_rgba(33,27,22,0.04)]">
            <div class="font-label-sm text-label-sm text-secondary uppercase tracking-wider">Proyecto</div>
            <div class="flex items-center gap-2 mt-1 min-w-0">
                <span class="w-2 h-2 rounded-full bg-tertiary-container shrink-0"></span>
                <span class="font-title-md text-body-sm font-semibold text-on-surface truncate">saludo-app</span>
            </div>
        </div>
    </div>

    <div class="px-4 py-2">
        <a href="{{ route('usuarios.registro') }}" class="flex items-center justify-between w-full px-3 py-2 bg-primary-fixed text-on-primary-fixed rounded-xl hover:bg-primary-fixed-dim transition-colors">
            <span class="flex items-center gap-2">
                <x-ui.icon name="person_add" size="18" class="text-primary" />
                <span class="font-label-md text-label-md">Nuevo usuario</span>
            </span>
            <x-ui.icon name="chevron_right" size="18" class="text-primary" />
        </a>
    </div>

    <div class="flex-1 overflow-y-auto px-3 py-2 space-y-4">
        @foreach ($grupos as $titulo => $enlaces)
            <nav class="space-y-1">
                <div class="px-2 py-1 font-label-sm text-label-sm text-secondary uppercase tracking-wider">{{ $titulo }}</div>
                @foreach ($enlaces as $enlace)
                    <a href="{{ $enlace['url'] }}"
                        @class([
                            'flex items-center gap-2 px-2.5 py-1.5 rounded-lg transition-colors font-body-sm text-body-sm',
                            'bg-surface-container-highest text-on-surface font-semibold' => $enlace['active'],
                            'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' => ! $enlace['active'],
                        ])
                        @if ($enlace['active']) aria-current="page" @endif>
                        <x-ui.icon :name="$enlace['icon']" size="18" />
                        {{ $enlace['label'] }}
                    </a>
                @endforeach
            </nav>
        @endforeach
    </div>

    <div class="px-4 pt-2">
        <div class="p-3 rounded-xl bg-surface-container-high flex flex-col gap-1.5">
            <div class="flex items-center gap-1.5 text-secondary font-label-sm text-label-sm">
                <x-ui.icon name="palette" size="14" />
                <span>Diseño</span>
            </div>
            <span class="font-code-sm text-code-sm text-on-surface truncate">Google Stitch · MCP</span>
        </div>
    </div>
</aside>
