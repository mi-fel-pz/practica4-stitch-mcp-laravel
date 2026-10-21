{{-- Riel principal (columna oscura de 76px) --}}
@php
    $modulos = [
        ['icon' => 'group', 'label' => 'Usuarios', 'url' => route('usuarios.index'), 'active' => request()->routeIs('usuarios.index', 'usuarios.editar')],
        ['icon' => 'person_add', 'label' => 'Registrar usuario', 'url' => route('usuarios.registro'), 'active' => request()->routeIs('usuarios.registro')],
        ['icon' => 'waving_hand', 'label' => 'Saludo', 'url' => url('/saludo'), 'active' => request()->is('saludo')],
    ];
@endphp

<aside class="fixed left-0 top-0 bottom-0 w-[76px] bg-rail z-50 flex flex-col justify-between items-center py-4 select-none">
    <div class="flex flex-col items-center w-full gap-5">
        <a href="{{ route('usuarios.index') }}" title="{{ config('app.name') }}" class="block w-11 h-11 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.35)]">
            <img src="{{ asset('images/logo-saludo.svg') }}" alt="Logo de saludo-app" class="w-11 h-11 rounded-xl">
        </a>

        <nav class="flex flex-col items-center gap-2 w-full px-2">
            @foreach ($modulos as $modulo)
                <a href="{{ $modulo['url'] }}" title="{{ $modulo['label'] }}"
                    @class([
                        'relative group flex items-center justify-center w-12 h-12 rounded-xl transition-all',
                        'bg-primary text-on-primary shadow-[0_2px_12px_rgba(148,69,44,0.4)]' => $modulo['active'],
                        'text-rail-ink hover:bg-rail-hover hover:text-white' => ! $modulo['active'],
                    ])>
                    <x-ui.icon :name="$modulo['icon']" size="22" />
                    <span class="absolute left-14 bg-inverse-surface text-inverse-on-surface font-label-md text-label-md px-2.5 py-1 rounded shadow-lg pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50">
                        {{ $modulo['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>
    </div>

    <button type="button" data-theme-toggle title="Modo día / noche"
        class="w-10 h-10 rounded-xl bg-[#201e1c] text-rail-ink hover:text-white hover:bg-[#2c2926] dark:text-tertiary-fixed dark:bg-[#1e2a24] flex items-center justify-center transition-all cursor-pointer">
        <x-ui.icon name="light_mode" size="20" data-theme-icon data-light="light_mode" data-dark="dark_mode" />
    </button>
</aside>
