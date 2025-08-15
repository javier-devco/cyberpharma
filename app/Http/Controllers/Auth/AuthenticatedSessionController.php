<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- ¡Importante!
use App\Models\User; // <-- ¡Importante!

class AuthenticatedSessionController extends Controller
{
    // ... (el método create() se queda igual) ...

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // --- CÓDIGO DE DEPURACIÓN ---

        $email = $request->input('email');
        $password = $request->input('password');

        // 1. Buscamos al usuario por su email.
        $user = User::where('email', $email)->first();

        // 2. Si el usuario no existe, nos detenemos y mostramos un error.
        if (!$user) {
            dd('ERROR FATAL: No se encontró ningún usuario con el email: ' . $email);
        }

        // 3. Obtenemos la contraseña encriptada de la base de datos.
        $hashedPasswordInDb = $user->password;

        // 4. Comparamos la contraseña que escribiste con la de la BD.
        $isPasswordCorrect = Hash::check($password, $hashedPasswordInDb);

        // 5. ¡LA PRUEBA FINAL! Nos detenemos y mostramos toda la información.
        dd([
            'Email que intentas usar' => $email,
            'Contraseña que escribiste' => $password,
            'Usuario encontrado en la BD' => $user->toArray(),
            'Contraseña ENCRIPTADA en la BD' => $hashedPasswordInDb,
            '¿Coincide la contraseña?' => $isPasswordCorrect,
            '¿Tiene permiso para entrar al panel?' => $user->can('access_panel'),
        ]);

        // --- FIN DEL CÓDIGO DE DEPURACIÓN ---


        // El código original de Laravel se queda debajo, pero no se ejecutará por el 'dd()'
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // ... (el método destroy() se queda igual) ...
}
