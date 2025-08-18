<?php

namespace App\Providers\Filament;

// Imports de tus Widgets (esto está bien, pero los dejaremos de referencia)
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UltimasVentas;
use App\Filament\Widgets\VentasChart;

// Imports de Filament y Laravel
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession; // <-- ¡RUTA CORREGIDA!
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\View;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
            ->brandName('Cyberpharma')
            ->spa()
            ->colors([
                'primary' => Color::hex('#ea9216'), // Usando el helper de Filament
                'success' => Color::hex('#1abc9c'),
            ])
            ->viteTheme('resources/css/filament/dashboard/theme.css')
            ->renderHook(
                'panels::user-menu.before',
                // Es más limpio devolver directamente el objeto View
                fn() => View::make('filament.custom.user-info'),
            )
            ->renderHook(
                'panels::footer',
                // La lógica para mostrar solo a usuarios logueados es perfecta
                fn() => auth()->check() ? View::make('filament.custom.footer') : '',
            )
            ->renderHook(
                'panels::head.end',
                fn() => View::make('filament.custom.head'),
            )
            ->plugins([
                // Aquí puedes añadir plugins en el futuro, como el de Shield
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Usar la clase directamente es la forma más estándar
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\VentasChart::class,
                \App\Filament\Widgets\UltimasVentas::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class, // <-- Ahora usa la clase correcta
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
