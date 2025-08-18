<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$permissions  // Acepta uno o más nombres de permisos
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        // El middleware 'auth' ya debería haber corrido, pero por seguridad verificamos.
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // LLAVE MAESTRA: Verificamos si el usuario tiene el permiso fundamental.
        // Asumimos que el permiso se llama 'acceso_panel_admin'.
        if (!$user->can('acceso_panel_admin')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('error', 'No tienes permiso para acceder al panel de administración.');
        }

        // Si la ruta no requiere permisos específicos, lo dejamos pasar.
        if (empty($permissions)) {
            return $next($request);
        }

        // Si la ruta SÍ requiere permisos, revisamos si el usuario tiene al menos uno de ellos.
        // El método can() de Spatie puede recibir un array de permisos.
        if ($user->hasAnyPermission($permissions)) {
            return $next($request); // Tiene al menos uno de los permisos, puede pasar.
        }

        // Si llega hasta aquí, no tiene los permisos necesarios.
        abort(403, 'Acceso No Autorizado.');
    }
}
