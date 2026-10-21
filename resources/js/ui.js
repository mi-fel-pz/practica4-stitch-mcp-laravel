/*
 | Comportamiento compartido de la interfaz MODULA:
 |  - Cambio de tema "Día Cálido" / "Noche Neón" (se guarda en localStorage)
 |  - Toast de notificación que se oculta solo
 |  - Selects que envían su formulario al cambiar
 |  - Atajo Ctrl/⌘ + K para enfocar el buscador
 */

const THEME_KEY = 'modula_theme';

function isDark() {
    return document.documentElement.classList.contains('dark');
}

function syncThemeControls() {
    const dark = isDark();
    document.querySelectorAll('[data-theme-icon]').forEach((el) => {
        el.textContent = dark ? el.dataset.dark : el.dataset.light;
    });
    document.querySelectorAll('[data-theme-text]').forEach((el) => {
        el.textContent = dark ? el.dataset.dark : el.dataset.light;
    });
}

function setTheme(dark) {
    document.documentElement.classList.toggle('dark', dark);
    try {
        localStorage.setItem(THEME_KEY, dark ? 'dark' : 'light');
    } catch (e) {
        /* almacenamiento no disponible: el tema solo dura en esta página */
    }
    syncThemeControls();
}

document.addEventListener('click', (event) => {
    if (event.target.closest('[data-theme-toggle]')) {
        setTheme(!isDark());
    }
});

function hideToast(toast) {
    toast.classList.add('translate-y-20', 'opacity-0');
}

function initToasts() {
    document.querySelectorAll('[data-toast]').forEach((toast) => {
        setTimeout(() => hideToast(toast), 3400);
    });
}

function initAutosubmit() {
    document.querySelectorAll('[data-autosubmit]').forEach((field) => {
        field.addEventListener('change', () => field.form?.requestSubmit());
    });
}

function initSearchShortcut() {
    window.addEventListener('keydown', (event) => {
        if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
            const search = document.querySelector('[data-search-shortcut]');
            if (search) {
                event.preventDefault();
                search.focus();
                search.select();
            }
        }
    });
}

function init() {
    syncThemeControls();
    initToasts();
    initAutosubmit();
    initSearchShortcut();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
