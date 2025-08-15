<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class Login extends BaseLogin
{
    // --- ¡LA CORRECCIÓN ESTÁ AQUÍ! ---
    // Esta línea le dice a nuestra clase que use la vista de Blade del login por defecto de Filament.
    protected static string $view = 'filament.pages.auth.login';

    // Esto lo mantenemos para quitar el título por defecto
    public function getHeading(): string | Htmlable
    {
        return '';
    }

    // El método de depuración se queda igual.
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $email = $data['email'];
        $password = $data['password'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            dd('DIAGNÓSTICO: No se encontró ningún usuario con el email: ' . $email);
        }

        $isPasswordCorrect = Hash::check($password, $user->password);

        dd([
            '--- DIAGNÓSTICO DE LOGIN ---' => 'Resultados de la prueba:',
            'Email Intentado' => $email,
            'Contraseña Escrita' => $password,
            'Roles del Usuario (según Spatie)' => $user->getRoleNames()->toArray(),
            '¿La Contraseña Coincide?' => $isPasswordCorrect,
            '¿Tiene Permiso de Acceso?' => $user->can('access_panel'),
            'Contraseña ENCRIPTADA en la BD' => $user->password,
        ]);
    }
}
