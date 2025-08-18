<?php

namespace App\Providers;

use App\Models\User; // <-- Asegúrate de tener este 'use'
use Illuminate\Support\Facades\Gate; // <-- Asegúrate de tener este 'use'
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // --- ¡LA LLAVE MAESTRA ESTÁ AQUÍ! ---
        // Gate::before() se ejecuta antes de cualquier otra regla de permisos.
        // Le decimos al sistema: "Si el usuario que intenta acceder tiene el ID 1,
        // concédele acceso total e incondicional a todo".
        Gate::before(function (User $user, string $ability) {
            return $user->id === 1 ? true : null;
        });
    }
}
