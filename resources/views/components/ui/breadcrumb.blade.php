{{-- Migas de pan. "items" es un arreglo texto => url (null para el elemento actual) --}}
@props(['items' => []])

<nav aria-label="Ruta de navegación" {{ $attributes->class('flex items-center gap-1.5 font-body-sm text-body-sm min-w-0') }}>
    @foreach ($items as $label => $url)
        @if (! $loop->first)
            <span class="text-secondary/60">/</span>
        @endif

        @if ($loop->last)
            <span class="font-semibold text-on-surface truncate" aria-current="page">{{ $label }}</span>
        @elseif ($url)
            <a href="{{ $url }}" class="text-on-surface-variant hover:text-on-surface transition-colors whitespace-nowrap">{{ $label }}</a>
        @else
            <span class="text-secondary whitespace-nowrap">{{ $label }}</span>
        @endif
    @endforeach
</nav>
