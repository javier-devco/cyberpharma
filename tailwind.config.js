import preset from './vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.php',
        './vendor/filament/**/*.blade.php',
        './resources/**/*.blade.php', // Añadimos las vistas de Laravel por si acaso
    ],
}