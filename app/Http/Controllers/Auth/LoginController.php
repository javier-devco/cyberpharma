<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * ¡LA SOLUCIÓN!
     * A dónde redirigir a los usuarios después del login.
     * Esta propiedad anula cualquier otro comportamiento por defecto y fuerza
     * la redirección a nuestro panel de Filament.
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
