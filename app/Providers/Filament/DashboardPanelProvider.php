<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UltimasVentas;
use App\Filament\Widgets\VentasChart;
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
use Illuminate\Session\Middleware\AuthenticateSession;
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
                'primary' => '#ea9216',
                'success' => '#1abc9c',
            ])

            // --- ¡LÍNEA AÑADIDA Y CLAVE! ---
            // Le decimos a Filament que cargue nuestro tema personalizado que compilamos.
            ->viteTheme('resources/css/filament/dashboard/theme.css')

            ->renderHook(
                'panels::user-menu.before',
                fn(): string => View::make('filament.custom.user-info')->render(),
            )
            ->renderHook(
                'panels::footer',
                fn(): string => auth()->check() ? View::make('filament.custom.footer')->render() : '',
            )
            ->renderHook(
                'panels::head.end',
                fn(): string => View::make('filament.custom.head')->render(),
            )
            ->plugins([
                //
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatsOverview::class,
                VentasChart::class,
                UltimasVentas::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
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
