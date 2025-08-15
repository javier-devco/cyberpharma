{{-- Ruta: resources/views/filament/custom/custom-brand.blade.php --}}

{{-- 1. Este CSS oculta el logo por defecto de "Laravel" --}}
<style>
    a[href="{{ filament()->getHomeUrl() }}"].fi-sidebar-brand-link {
        display: none !important;
    }
</style>

{{-- 2. Este es nuestro nuevo logo, que inyectaremos en su lugar --}}
<a href="{{ filament()->getHomeUrl() }}" class="block px-4 py-3">
    <img src="{{ asset('images/logo_completo.png') }}" alt="Cyberpharma Logo"
        class="w-auto"
        style="height: 60px !important;"> {{-- <-- ¡Puedes ajustar el tamaño aquí! --}}
</a>