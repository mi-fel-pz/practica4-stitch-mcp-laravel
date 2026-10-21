{{-- Listado de usuarios · diseño generado con Google Stitch (pantalla "Catálogo de usuarios") --}}
@extends('layouts.app')

@section('title', 'Usuarios')

@section('breadcrumb')
    <x-ui.breadcrumb :items="['saludo-app' => url('/'), 'Usuarios' => null]" />
@endsection

@section('content')
    <div class="w-full px-8 py-7 space-y-7">
        <header class="flex flex-col xl:flex-row xl:items-end justify-between gap-6">
            <div class="space-y-1.5">
                <x-ui.badge tone="primary" class="uppercase tracking-wider">Usuarios</x-ui.badge>
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Listado de usuarios</h1>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
                    Cuentas registradas en la tabla <code class="font-code-sm text-code-sm bg-surface-container px-1.5 py-0.5 rounded">users</code>, de la más reciente a la más antigua.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.theme-toggle light-icon="dark_mode" dark-icon="light_mode" light-text="Modo noche" dark-text="Modo día"
                    class="px-3.5 py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-on-surface shadow-sm" />
                <x-ui.button icon="person_add" :href="route('usuarios.registro')">Registrar usuario</x-ui.button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.stat-card label="Usuarios registrados" icon="group">
                <span class="block font-headline-md text-headline-md text-on-surface font-bold">{{ $totales['usuarios'] }}</span>
                <span class="font-code-sm text-code-sm text-secondary">en total</span>
            </x-ui.stat-card>

            <x-ui.stat-card label="Últimos 7 días" icon="trending_up" icon-class="bg-surface-container text-tertiary">
                <span class="block font-headline-md text-headline-md text-on-surface font-bold">{{ $totales['semana'] }}</span>
                <span class="font-code-sm text-code-sm text-secondary">{{ $totales['hoy'] }} registrados hoy</span>
            </x-ui.stat-card>

            <x-ui.stat-card label="Último registro" icon="schedule" icon-class="bg-primary-fixed text-on-primary-fixed">
                <span class="block font-title-md text-title-md text-on-surface truncate">{{ $ultimo->name ?? 'Nadie todavía' }}</span>
                <span class="font-code-sm text-code-sm text-secondary">{{ $ultimo?->created_at?->locale('es')->diffForHumans() ?? '—' }}</span>
            </x-ui.stat-card>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 p-3 rounded-2xl bg-surface-container-low shadow-sm">
            <form method="GET" action="{{ route('usuarios.index') }}" role="search" class="flex flex-1 items-center gap-2">
                <div class="relative flex items-center flex-1 max-w-md">
                    <x-ui.icon name="search" size="18" class="absolute left-3 text-secondary" />
                    <input type="search" name="q" value="{{ $buscar }}" data-search-shortcut
                        placeholder="Buscar por nombre o correo…"
                        class="w-full pl-9 pr-16 py-1.5 rounded-xl bg-surface-container-lowest font-body-sm text-body-sm text-on-surface placeholder:text-secondary shadow-sm focus:outline-none focus:ring-1 focus:ring-primary">
                    <kbd class="absolute right-2 px-1.5 py-0.5 rounded bg-surface-container text-secondary font-code-sm text-code-sm">Ctrl K</kbd>
                </div>
                <x-ui.button type="submit" variant="ghost" size="sm" class="shadow-sm">Buscar</x-ui.button>
                @if ($buscar !== '')
                    <x-ui.button variant="link" :href="route('usuarios.index')">Limpiar</x-ui.button>
                @endif
            </form>
            <span class="font-code-sm text-code-sm text-secondary px-2">{{ $usuarios->total() }} resultado(s)</span>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-secondary font-label-sm text-label-sm uppercase tracking-wider">
                            <th class="py-3 px-4">Usuario</th>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Registrado</th>
                            <th class="py-3 px-4">Última actualización</th>
                            <th class="py-3 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="font-body-sm text-body-sm text-on-surface">
                        @forelse ($usuarios as $usuario)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar :name="$usuario->name" />
                                        <div class="min-w-0 max-w-[320px]">
                                            <span class="font-title-md text-body-md font-semibold text-on-surface block truncate">{{ $usuario->name }}</span>
                                            <span class="font-code-sm text-code-sm text-secondary truncate block">{{ $usuario->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 font-code-sm text-code-sm text-on-surface-variant">#{{ $usuario->id }}</td>
                                <td class="py-3.5 px-4 text-on-surface-variant whitespace-nowrap">{{ $usuario->created_at?->format('d/m/Y H:i') }}</td>
                                <td class="py-3.5 px-4 text-on-surface-variant whitespace-nowrap">{{ $usuario->updated_at?->locale('es')->diffForHumans() }}</td>
                                <td class="py-3.5 px-4 text-right">
                                    <x-ui.button variant="ghost" size="sm" icon="edit" :href="route('usuarios.editar', $usuario)" class="text-primary!">
                                        Editar perfil
                                    </x-ui.button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-4 text-center text-secondary">
                                    <span class="flex justify-center mb-2"><x-ui.icon name="person_search" size="32" /></span>
                                    @if ($buscar !== '')
                                        Ningún usuario coincide con "{{ $buscar }}".
                                        <a href="{{ route('usuarios.index') }}" class="text-primary font-semibold hover:underline">Ver todos</a>
                                    @else
                                        Todavía no hay usuarios.
                                        <a href="{{ route('usuarios.registro') }}" class="text-primary font-semibold hover:underline">Registra el primero</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-3 text-secondary">
                <span class="font-code-sm text-code-sm text-on-surface">
                    Mostrando {{ $usuarios->firstItem() ?? 0 }} - {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios
                </span>
                <div class="flex items-center gap-1">
                    @if ($usuarios->onFirstPage())
                        <span class="p-1.5 rounded-lg bg-surface-container text-on-surface opacity-50"><x-ui.icon name="chevron_left" size="16" /></span>
                    @else
                        <a href="{{ $usuarios->previousPageUrl() }}" title="Anterior" class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface"><x-ui.icon name="chevron_left" size="16" /></a>
                    @endif
                    <span class="px-2.5 py-1 rounded-lg bg-surface-container-lowest text-on-surface font-code-sm text-code-sm font-semibold shadow-sm">
                        {{ $usuarios->currentPage() }} / {{ $usuarios->lastPage() }}
                    </span>
                    @if ($usuarios->hasMorePages())
                        <a href="{{ $usuarios->nextPageUrl() }}" title="Siguiente" class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface"><x-ui.icon name="chevron_right" size="16" /></a>
                    @else
                        <span class="p-1.5 rounded-lg bg-surface-container text-on-surface opacity-50"><x-ui.icon name="chevron_right" size="16" /></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
