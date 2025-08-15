<x-filament::dropdown.trigger
    class="-m-1.5 flex items-center p-1.5">
    <div class="flex items-center gap-x-3">

        <x-filament::avatar
            :user="auth()->user()"
            :size="'md'"
            class="!h-9 !w-9" />

        <div class="hidden lg:flex lg:flex-col lg:items-start">

            <span class="text-sm font-semibold text-gray-950 dark:text-white">
                {{ auth()->user()->getFilamentName() }}
            </span>

            <span class="text-xs text-gray-500 dark:text-gray-400">
                {{-- Esta línea es a prueba de fallos. No dará error si no hay rol. --}}
                {{ optional(auth()->user()->roles->first())->name }}
            </span>

        </div>

    </div>
</x-filament::dropdown.trigger>```

#### Paso 3: Reiniciar el Servidor (Opcional pero recomendado)

Si estás usando `php artisan serve`, a veces es bueno detenerlo (`Ctrl + C`) y volverlo a iniciar después de limpiar los cachés para asegurar que todo se recargue desde cero.

```bash
php artisan serve