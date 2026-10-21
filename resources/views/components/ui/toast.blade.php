{{-- Notificación flotante. Se muestra cuando el controlador redirige con ->with('status', '...') --}}
@if (session('status'))
    <div data-toast role="status" aria-live="polite"
        class="fixed bottom-6 right-8 z-50 flex items-center gap-3 px-4 py-3 rounded-2xl bg-inverse-surface text-inverse-on-surface shadow-2xl transition-all duration-300">
        <x-ui.icon :name="session('status_icon', 'check_circle')" size="20" class="text-tertiary-fixed" />
        <span class="font-body-sm text-body-sm font-medium">{{ session('status') }}</span>
    </div>
@endif
