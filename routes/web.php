<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirige la página de inicio directamente al login del panel.
Route::get('/', function () {
    return redirect('/dashboard');
});

// Mantenemos las rutas de autenticación que Laravel provee (login, logout, etc.)
Auth::routes();

// ¡IMPORTANTE! Eliminamos la ruta Route::get('/home', ...) que causaba el conflicto.