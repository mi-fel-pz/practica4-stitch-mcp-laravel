{{--
    Layout principal (Práctica 4, paso 6.2): <head>, fuentes y directiva @vite.
    Las vistas lo usan con @extends('layouts.app') y @section('content').

    - Con menú (listado y editar perfil): solo definen @section('content').
    - Pantalla completa de dos columnas (registro): además definen @section('marca').
--}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inicio') · {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/logo-saludo.svg') }}" type="image/svg+xml">

    {{-- Aplica el tema guardado (día / noche) antes de pintar --}}
    <script>
        (function () {
            try {
                var saved = localStorage.getItem('modula_theme');
                if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>

    {{-- Fuentes del sistema de diseño de Stitch --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background font-body-md text-body-md text-on-surface antialiased">
    @hasSection('marca')
        {{-- Pantalla completa: panel de marca + formulario --}}
        <div class="min-h-screen grid lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)]">
            <aside class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-rail text-inverse-on-surface p-12">
                <div class="absolute -left-24 -bottom-24 w-[28rem] h-[28rem] rounded-full bg-primary/25 blur-3xl pointer-events-none"></div>
                <div class="absolute right-0 top-1/3 w-64 h-64 rounded-full bg-tertiary-container/15 blur-3xl pointer-events-none"></div>

                <a href="{{ route('usuarios.index') }}" class="relative flex items-center gap-3">
                    <img src="{{ asset('images/logo-saludo.svg') }}" alt="Logo de saludo-app" class="w-11 h-11 shadow-[0_2px_12px_rgba(148,69,44,0.4)] rounded-xl">
                    <span class="font-headline-sm text-headline-sm text-white">saludo-app</span>
                </a>

                <div class="relative space-y-6 max-w-md">
                    @yield('marca')
                </div>

                <p class="relative font-label-sm text-label-sm text-rail-ink/70 uppercase tracking-wider">Diseño generado con Google Stitch</p>
            </aside>

            <main class="flex items-center justify-center px-5 py-10 sm:px-10">
                <div class="w-full max-w-xl">
                    @yield('content')
                </div>
            </main>
        </div>

        <div class="fixed top-4 right-4">
            <x-ui.theme-toggle light-icon="dark_mode" dark-icon="light_mode" light-text="Modo noche" dark-text="Modo día"
                class="px-3 py-1.5 rounded-xl bg-surface-container-lowest text-on-surface-variant shadow-sm hover:bg-surface-container" />
        </div>
    @else
        {{-- Con menú: riel, panel lateral y barra superior --}}
        <x-layout.rail />
        <x-layout.sidebar />

        <div class="pl-[316px]">
            <x-layout.topbar>
                @yield('breadcrumb')
            </x-layout.topbar>

            <main class="relative pt-16 bg-surface min-h-screen transition-colors duration-300">
                @yield('content')
            </main>
        </div>
    @endif

    <x-ui.toast />
    @stack('scripts')
</body>
</html>
