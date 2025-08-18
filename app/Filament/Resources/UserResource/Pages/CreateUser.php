<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model; // Importante

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Esta función se ejecuta DESPUÉS de que el usuario ha sido creado.
     */
    protected function afterCreate(): void
    {
        // Obtiene los datos del formulario
        $data = $this->form->getState();
        // Obtiene el usuario que se acaba de crear
        $user = $this->record;

        // Asigna el rol después de la creación
        if (isset($data['roles'])) {
            $user->assignRole($data['roles']);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
