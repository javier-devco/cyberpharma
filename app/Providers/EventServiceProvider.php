<?php

namespace App\Providers;

use App\Models\Compra;
use App\Models\Inventario; // <-- PASO 1: AÑADE ESTA LÍNEA
use App\Models\Pedido;
use App\Models\Venta;
use App\Observers\CompraObserver;
use App\Observers\InventarioObserver; // <-- PASO 2: AÑADE ESTA LÍNEA
use App\Observers\PedidoObserver;
use App\Observers\VentaObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * ¡SECCIÓN MODIFICADA!
     * Aquí le decimos a Laravel qué Observer vigila a qué Modelo.
     */
    protected $observers = [
        Venta::class => [VentaObserver::class],
        Compra::class => [CompraObserver::class],
        Pedido::class => [PedidoObserver::class],
        Inventario::class => [InventarioObserver::class], // <-- PASO 3: AÑADE ESTA LÍNEA
    ];

    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
