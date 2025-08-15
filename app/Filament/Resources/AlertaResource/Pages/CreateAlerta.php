<?php

namespace App\Filament\Resources\AlertaResource\Pages;

use App\Filament\Resources\AlertaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAlerta extends CreateRecord
{
    protected static string $resource = AlertaResource::class;

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
