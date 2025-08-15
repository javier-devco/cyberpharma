<?php

namespace App\Filament\Resources\AlertaResource\Pages;

use App\Filament\Resources\AlertaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlerta extends EditRecord
{
    protected static string $resource = AlertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * ¡CÓDIGO AÑADIDO!
     * Sobrescribe el comportamiento por defecto y fuerza la redirección
     * a la página de listado (index) después de guardar los cambios.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
