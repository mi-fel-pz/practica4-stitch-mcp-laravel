{{-- Barra superior fija: migas de pan (slot) --}}
<header class="fixed top-0 left-[316px] right-0 h-16 bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-30 flex items-center justify-between gap-4 px-6 transition-colors duration-300">
    <div class="flex items-center gap-3 min-w-0">
        {{ $slot }}
    </div>

    <span class="hidden md:flex items-center gap-2 px-3 py-1 bg-surface-container-lowest rounded-full shadow-[0_1px_3px_rgba(33,27,22,0.04)] whitespace-nowrap">
        <span class="w-2 h-2 rounded-full bg-tertiary-fixed-dim"></span>
        <span class="font-label-md text-label-md text-on-surface">Práctica 4</span>
        <span class="text-secondary">•</span>
        <span class="font-label-sm text-label-sm text-secondary">Stitch + Laravel</span>
    </span>
</header>
