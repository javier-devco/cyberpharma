<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Permisos agrupados por módulo para mayor orden
        // ----------------------------------------------------

        // Permisos para el módulo de Usuarios
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'borrar usuarios']);

        // Permisos para el módulo de Roles
        Permission::create(['name' => 'ver roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'borrar roles']);

        // Permisos para el módulo de Productos
        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'editar productos']);
        Permission::create(['name' => 'borrar productos']);

        // ... puedes añadir más permisos para proveedores, ventas, etc.

        // Crear Roles y asignarles permisos
        // -------------------------------------

        // Rol de Administrador (acceso a todo)
        $adminRole = Role::create(['name' => 'Administrador']);
        $adminRole->givePermissionTo(Permission::all()); // Asigna todos los permisos

        // Rol de Regente
        $regenteRole = Role::create(['name' => 'Regente']);
        $regenteRole->givePermissionTo([
            'ver productos',
            'editar productos',
            'ver usuarios', // Por ejemplo, un regente puede ver usuarios pero no crearlos
        ]);

        // Rol de Bodega
        $bodegaRole = Role::create(['name' => 'Bodega']);
        $bodegaRole->givePermissionTo('ver productos'); // Solo puede ver productos

        // Rol de Venta
        $ventaRole = Role::create(['name' => 'Venta']);
        $ventaRole->givePermissionTo([
            'ver productos',
            // ... y permisos de ventas cuando los crees
        ]);
    }
}
