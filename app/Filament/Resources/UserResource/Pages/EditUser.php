<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model; // Importante

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Esta función se ejecuta DESPUÉS de que el usuario ha sido guardado.
     */
    protected function afterSave(): void
    {
        // Obtiene los datos del formulario
        $data = $this->form->getState();
        // Obtiene el usuario que se acaba de editar
        $user = $this->record;

        // Sincroniza los roles después de guardar
        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
