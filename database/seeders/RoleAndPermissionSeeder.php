<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de permisos de Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREACIÓN DE PERMISOS ---
        // (nombre clave, grupo, descripción legible)

        // Permiso Maestro
        Permission::create(['name' => 'acceso_panel_admin', 'group_name' => 'panel', 'description' => 'Permitir acceso al panel de administración']);

        // Permisos para el Módulo de Roles
        Permission::create(['name' => 'ver_roles', 'group_name' => 'roles', 'description' => 'Ver listado de Roles y Permisos']);
        Permission::create(['name' => 'crear_roles', 'group_name' => 'roles', 'description' => 'Crear nuevos Roles']);
        Permission::create(['name' => 'editar_roles', 'group_name' => 'roles', 'description' => 'Editar Roles y Permisos']);
        Permission::create(['name' => 'borrar_roles', 'group_name' => 'roles', 'description' => 'Borrar Roles']);

        // Permisos para el Módulo de Productos/Inventario
        Permission::create(['name' => 'ver_inventario', 'group_name' => 'inventario', 'description' => 'Ver Inventario']);
        Permission::create(['name' => 'crear_productos', 'group_name' => 'inventario', 'description' => 'Crear Productos']);
        Permission::create(['name' => 'editar_productos', 'group_name' => 'inventario', 'description' => 'Editar Productos']);
        Permission::create(['name' => 'borrar_productos', 'group_name' => 'inventario', 'description' => 'Borrar Productos']);

        // Permisos para el Módulo de Ventas
        Permission::create(['name' => 'ver_ventas', 'group_name' => 'ventas', 'description' => 'Ver listado de Ventas']);
        Permission::create(['name' => 'crear_ventas', 'group_name' => 'ventas', 'description' => 'Crear nuevas Ventas']);


        // --- CREACIÓN DE ROLES ---
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $rolVendedor = Role::create(['name' => 'Vendedor']);
        $rolBodeguero = Role::create(['name' => 'Bodeguero']);

        // --- ASIGNACIÓN DE PERMISOS A ROLES ---

        // El Administrador tiene todos los permisos
        $rolAdmin->syncPermissions(Permission::all());

        // El Vendedor solo puede acceder, ver inventario y crear ventas
        $rolVendedor->syncPermissions([
            'acceso_panel_admin',
            'ver_inventario',
            'crear_ventas'
        ]);

        // El Bodeguero puede acceder y gestionar el inventario
        $rolBodeguero->syncPermissions([
            'acceso_panel_admin',
            'ver_inventario',
            'editar_productos'
        ]);
    }
}
