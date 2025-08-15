{{-- Ruta: resources/views/vendor/filament-panels/components/brand.blade.php --}}

<a href="{{ filament()->getHomeUrl() }}" class="flex items-center gap-x-3">

    {{-- Tu logo --}}
    <img src="{{ asset('images/logo_completo.png') }}" alt="Cyberpharma Logo"
        class="h-10"> {{-- <-- Puedes ajustar el tamaño aquí (ej. h-8, h-12) --}}

    {{-- El nombre de tu marca --}}
    <span class="text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
        Cyberpharma
    </span>

</a>