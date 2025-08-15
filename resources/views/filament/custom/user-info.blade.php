{{-- Ruta: resources/views/filament/custom/user-info.blade.php --}}
@php
// Obtenemos la información del usuario que ha iniciado sesión
$user = auth()->user();
@endphp

{{-- Contenedor con estilos de Filament para alinear el texto --}}
<div class="px-4 py-3 text-right">
    {{-- Mostramos el nombre completo del usuario --}}
    <p class="text-sm font-medium text-gray-950 dark:text-white">
        {{ $user->getFilamentName() }}
    </p>
    {{-- Mostramos el primer rol del usuario --}}
    <p class="text-xs text-gray-500 dark:text-gray-400">
        {{ $user->getRoleNames()->first() ?? 'Sin Rol' }}
    </p>
</div>