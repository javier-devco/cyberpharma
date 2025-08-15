import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // --- ¡LÍNEA AÑADIDA! ---
                // Aquí le decimos a Vite que también debe compilar nuestro tema de Filament.
                'resources/css/filament/dashboard/theme.css',
            ],
            refresh: true,
        }),
    ],
});