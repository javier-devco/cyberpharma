<?php

namespace App\Filament\Resources\ProveedorResource\Pages;

use App\Filament\Resources\ProveedorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProveedor extends CreateRecord
{
    protected static string $resource = ProveedorResource::class;

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
