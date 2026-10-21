{{-- Editar perfil · diseño generado con Google Stitch (pantalla "Editar perfil / preferencias de cuenta") --}}
@extends('layouts.app')

@section('title', 'Editar perfil')

@section('breadcrumb')
    <x-ui.breadcrumb :items="['saludo-app' => url('/'), 'Usuarios' => route('usuarios.index'), 'Editar perfil' => null]" />
@endsection

@section('content')
    <div class="px-8 py-8 w-full max-w-6xl mx-auto space-y-8">
        {{-- Banner de identidad --}}
        <section class="relative overflow-hidden rounded-2xl bg-surface-container-lowest shadow-md p-8">
            <div class="absolute -right-20 -top-24 w-80 h-80 rounded-full bg-gradient-to-br from-primary-fixed/30 via-surface-tint/5 to-transparent blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <x-ui.avatar :name="$usuario->name" size="w-24 h-24" rounded="rounded-2xl"
                        class="bg-primary-fixed text-on-primary-fixed shadow-md text-headline-md" />
                    <div class="space-y-1.5">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">{{ $usuario->name }}</h1>
                            <x-ui.badge tone="success" dot>Activo</x-ui.badge>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 font-body-sm text-body-sm text-secondary">
                            <span class="flex items-center gap-1.5"><x-ui.icon name="mail" size="16" class="text-primary" /> {{ $usuario->email }}</span>
                            <span class="flex items-center gap-1.5"><x-ui.icon name="calendar_today" size="16" class="text-tertiary" /> Miembro desde {{ $usuario->created_at?->format('d/m/Y') }}</span>
                            <span class="font-code-sm text-code-sm text-on-surface-variant bg-surface-container px-2 py-0.5 rounded">ID: {{ $usuario->id }}</span>
                        </div>
                    </div>
                </div>
                <x-ui.theme-toggle light-icon="dark_mode" dark-icon="light_mode" light-text="Modo noche" dark-text="Modo día"
                    class="px-3.5 py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-primary shadow-sm" />
            </div>
        </section>

        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" novalidate>
            @csrf
            @method('PUT')

            <div class="lg:col-span-7 space-y-8">
                <x-ui.card title="1. Información personal" dot="bg-primary" icon="badge"
                    description="El nombre y el correo con los que aparece en el listado.">
                    <x-ui.input name="name" label="Nombre completo" icon="person" :value="$usuario->name" autocomplete="name" required />
                    <x-ui.input name="email" type="email" label="Correo electrónico" icon="mail" :value="$usuario->email" autocomplete="email" required />
                </x-ui.card>
            </div>

            <div class="lg:col-span-5 space-y-8">
                <x-ui.card title="2. Cambiar contraseña" dot="bg-tertiary" icon="key"
                    description="Déjalo en blanco si no quieres cambiarla." class="p-6!">
                    <div class="space-y-4">
                        <x-ui.input name="password" type="password" label="Nueva contraseña" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
                        <x-ui.input name="password_confirmation" type="password" label="Confirmar nueva contraseña" autocomplete="new-password" />
                    </div>
                </x-ui.card>

                <section class="p-5 rounded-2xl bg-surface-container-low space-y-2">
                    <div class="flex items-center justify-between font-label-sm text-label-sm text-secondary uppercase tracking-wider">
                        <span>Actividad</span>
                        <x-ui.icon name="history" size="16" />
                    </div>
                    <p class="font-body-sm text-body-sm text-secondary">Última actualización: {{ $usuario->updated_at?->locale('es')->diffForHumans() }}.</p>
                </section>
            </div>

            {{-- Barra de acciones --}}
            <div class="lg:col-span-12 sticky bottom-6 z-20 p-4 rounded-2xl bg-surface-container-lowest/95 backdrop-blur-md shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="font-body-sm text-body-sm text-secondary">Los cambios se guardan en la tabla <code class="font-code-sm text-code-sm">users</code>.</span>
                <div class="flex items-center gap-3">
                    <x-ui.button variant="secondary" :href="route('usuarios.index')">Volver al listado</x-ui.button>
                    <x-ui.button type="submit" size="lg" icon="save">Guardar cambios</x-ui.button>
                </div>
            </div>
        </form>
    </div>
@endsection
