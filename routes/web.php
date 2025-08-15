<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Redirige la página de inicio directamente a la página de login de tu panel.
    return redirect()->route('filament.dashboard.auth.login');
});
