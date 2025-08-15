<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'access_panel', 'guard_name' => 'web']);

        // --- ¡LISTA ACTUALIZADA! ---
        $resources = [
            'alerta',
            'compra',
            'estado',
            'factura',
            'medida_producto',
            'pedido',
            'producto',
            'proveedor',
            'role',
            'user',
            'venta',
            'inventario' // <-- AÑADIDO
        ];

        $actions = ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => $action . '_' . $resource, 'guard_name' => 'web']);
            }
        }

        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin', 'guard_name' => 'web']);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
