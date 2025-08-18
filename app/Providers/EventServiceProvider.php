<?php

namespace App\Providers;

use App\Models\Compra;
use App\Models\Venta;
use App\Observers\CompraObserver;
use App\Observers\VentaObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * ¡LA SECCIÓN MÁS IMPORTANTE!
     * Aquí registramos nuestros observers.
     */
    protected $observers = [
        Venta::class => [VentaObserver::class],
        Compra::class => [CompraObserver::class],
    ];

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
