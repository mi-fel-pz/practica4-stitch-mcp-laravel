{{--
    Foto de perfil. Si la imagen no existe en public/ muestra un icono o las iniciales,
    así la vista funciona aunque todavía no hayas copiado las imágenes.
--}}
@props(['src' => null, 'url' => null, 'name' => '', 'icon' => null, 'size' => 'w-9 h-9', 'rounded' => 'rounded-full'])

@php
    // "url" = dirección directa de la imagen; "src" = ruta dentro de public/
    $imageUrl = $url ?: ($src && file_exists(public_path($src)) ? asset($src) : null);
    $initials = collect(preg_split('/\s+/', trim($name)))
        ->reject(fn ($word) => str_ends_with($word, '.'))
        ->take(2)
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');
@endphp

<span {{ $attributes->class([
    'relative inline-flex items-center justify-center overflow-hidden shrink-0 bg-surface-container-highest text-on-surface-variant',
    $size,
    $rounded,
]) }}>
    @if ($imageUrl)
        <img src="{{ $imageUrl }}" alt="{{ $name }}" class="w-full h-full object-cover">
    @elseif ($icon)
        <x-ui.icon :name="$icon" size="20" />
    @else
        <span class="font-title-md text-body-sm font-bold">{{ $initials }}</span>
    @endif
</span>
