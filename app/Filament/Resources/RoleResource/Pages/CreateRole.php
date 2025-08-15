<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    // Propiedad temporal para guardar los permisos
    protected array $permissions_to_sync = [];

    // Este método recoge los datos de todas las secciones y los une antes de crear.
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $permissions = [];
        foreach ($data as $key => $value) {
            if ($key !== 'name' && is_array($value)) {
                $permissions = array_merge($permissions, array_keys(array_filter($value)));
                unset($data[$key]); // Limpiamos la clave temporal
            }
        }

        // Guardamos los permisos en nuestra propiedad temporal
        $this->permissions_to_sync = $permissions;

        return $data; // Devolvemos solo los datos para la tabla 'roles'
    }

    // Este método se ejecuta DESPUÉS de que el rol ha sido creado
    protected function afterCreate(): void
    {
        $role = $this->getRecord();
        // Sincronizamos los permisos usando la función de Spatie
        $role->syncPermissions($this->permissions_to_sync);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
