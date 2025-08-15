<?php

namespace App\Filament\Resources\EstadoResource\Pages;

use App\Filament\Resources\EstadoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstado extends CreateRecord
{
    protected static string $resource = EstadoResource::class;

    /**
     * ¡CÓDIGO AÑADIDO!
     * Sobrescribe el comportamiento por defecto y fuerza la redirección
     * a la página de listado (index) después de una creación exitosa.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
