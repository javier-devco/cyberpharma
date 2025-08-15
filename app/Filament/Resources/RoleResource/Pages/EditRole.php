<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    // Propiedad temporal para guardar los permisos
    protected array $permissions_to_sync = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Este método carga los permisos existentes en los checkboxes correctos.
    protected function mutateDataBeforeFill(array $data): array
    {
        $permissions = $this->record->permissions->pluck('name')->toArray();
        $actions = ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'];

        foreach ($permissions as $permission) {
            $resource = '';
            foreach ($actions as $action) {
                if (Str::startsWith($permission, $action . '_')) {
                    $resource = Str::after($permission, $action . '_');
                    break;
                }
            }
            if (!empty($resource)) {
                $data[$resource][$permission] = true;
            }
        }
        return $data;
    }

    // Este método recoge y guarda los permisos al hacer clic en "Guardar cambios".
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $permissions = [];
        foreach ($data as $key => $value) {
            if ($key !== 'name' && is_array($value)) {
                $permissions = array_merge($permissions, array_keys(array_filter($value)));
                unset($data[$key]);
            }
        }
        $this->permissions_to_sync = $permissions;
        return $data;
    }

    // Guarda los permisos después de que el rol ha sido actualizado
    protected function afterSave(): void
    {
        $role = $this->getRecord();
        $role->syncPermissions($this->permissions_to_sync);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
