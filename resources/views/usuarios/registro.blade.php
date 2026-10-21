{{-- Registro de usuario · diseño generado con Google Stitch ("Warm Architectural Craft") --}}
@extends('layouts.app')

@section('title', 'Registrar usuario')

@section('marca')
    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-primary/30 text-primary-fixed font-label-sm text-label-sm uppercase tracking-wider">
        Nuevo usuario
    </span>
    <h1 class="font-display text-display text-white">Crea tu cuenta en saludo-app.</h1>
    <p class="font-body-lg text-body-lg text-rail-ink">
        Registra un usuario nuevo. Después podrás verlo en el listado y editar su perfil.
    </p>
    <ul class="space-y-3 pt-2">
        <li class="flex items-center gap-3 font-body-md text-body-md text-rail-ink">
            <span class="w-8 h-8 rounded-lg bg-rail-raised flex items-center justify-center text-primary-fixed-dim"><x-ui.icon name="group" size="18" /></span>
            Aparece en el listado de usuarios
        </li>
        <li class="flex items-center gap-3 font-body-md text-body-md text-rail-ink">
            <span class="w-8 h-8 rounded-lg bg-rail-raised flex items-center justify-center text-primary-fixed-dim"><x-ui.icon name="manage_accounts" size="18" /></span>
            Puedes editar su perfil cuando quieras
        </li>
        <li class="flex items-center gap-3 font-body-md text-body-md text-rail-ink">
            <span class="w-8 h-8 rounded-lg bg-rail-raised flex items-center justify-center text-primary-fixed-dim"><x-ui.icon name="lock" size="18" /></span>
            La contraseña se guarda encriptada
        </li>
    </ul>
@endsection

@section('content')
    <div class="space-y-8">
        <div class="space-y-1.5">
            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider">Registro de usuario</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Crear cuenta</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">
                ¿Solo quieres ver quién está registrado?
                <a href="{{ route('usuarios.index') }}" class="text-primary font-semibold hover:underline">Ver el listado</a>
            </p>
        </div>

        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-8" novalidate>
            @csrf

            <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-7 shadow-sm space-y-5">
                <x-ui.input name="name" label="Nombre completo" icon="badge"
                    placeholder="Ej. Britney Félix" autocomplete="name" required />

                <x-ui.input name="email" type="email" label="Correo electrónico" icon="mail"
                    placeholder="tucorreo@ejemplo.com" autocomplete="email" required />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <x-ui.input name="password" type="password" label="Contraseña" icon="lock"
                        placeholder="Mínimo 8 caracteres" autocomplete="new-password" required data-password-strength />
                    <x-ui.input name="password_confirmation" type="password" label="Confirmar contraseña" icon="lock"
                        placeholder="Repite la contraseña" autocomplete="new-password" required />
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between font-label-sm text-label-sm">
                        <span class="text-secondary">Fortaleza de la contraseña</span>
                        <span class="text-secondary" data-strength-label>Sin evaluar</span>
                    </div>
                    <div class="w-full h-1.5 flex gap-1">
                        @for ($i = 0; $i < 4; $i++)
                            <span class="h-full flex-1 rounded-full bg-surface-container transition-colors" data-strength-bar></span>
                        @endfor
                    </div>
                </div>
            </section>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-4">
                <x-ui.button variant="soft" :href="route('usuarios.index')" icon="arrow_back" class="border-transparent">Volver al listado</x-ui.button>
                <x-ui.button type="submit" size="lg" icon="person_add">Registrar usuario</x-ui.button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Medidor de fortaleza de la contraseña
        (function () {
            const input = document.querySelector('[data-password-strength]');
            const bars = document.querySelectorAll('[data-strength-bar]');
            const label = document.querySelector('[data-strength-label]');
            if (!input) return;
            const niveles = [
                { texto: 'Sin evaluar', color: 'text-secondary', barra: 'bg-surface-container' },
                { texto: 'Débil', color: 'text-error', barra: 'bg-error' },
                { texto: 'Regular', color: 'text-primary', barra: 'bg-primary-container' },
                { texto: 'Buena', color: 'text-tertiary', barra: 'bg-tertiary-fixed-dim' },
                { texto: 'Excelente', color: 'text-tertiary', barra: 'bg-tertiary' },
            ];
            input.addEventListener('input', () => {
                const v = input.value;
                let p = 0;
                if (v.length >= 8) p++;
                if (v.length >= 12) p++;
                if (/[A-Z]/.test(v) && /[a-z]/.test(v)) p++;
                if (/\d/.test(v) && /[^A-Za-z0-9]/.test(v)) p++;
                p = v ? Math.max(1, p) : 0;
                const n = niveles[p];
                bars.forEach((b, i) => {
                    b.classList.remove(...niveles.map((x) => x.barra));
                    b.classList.add(i < p ? n.barra : 'bg-surface-container');
                });
                label.classList.remove(...niveles.map((x) => x.color));
                label.classList.add(n.color);
                label.textContent = n.texto;
            });
        })();
    </script>
@endpush
