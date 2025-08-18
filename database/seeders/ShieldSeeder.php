<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- 1. CREA EL PERMISO MAESTRO ---
        Permission::firstOrCreate(['name' => 'acceso_panel_admin', 'guard_name' => 'web']);

        // --- 2. CREA EL ROL DE SUPER-ADMIN ---
        // Usamos firstOrCreate para evitar duplicados si se ejecuta varias veces.
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin', 'guard_name' => 'web']);

        // --- 3. ASIGNA EL PERMISO MAESTRO AL SUPER-ADMIN ---
        // Usamos givePermissionTo para asegurarnos de que tenga al menos este permiso.
        $superAdminRole->givePermissionTo('acceso_panel_admin');

        // --- 4. CREA (O ENCUENTRA) EL USUARIO ADMINISTRADOR ---
        $user = User::firstOrCreate(
            ['email' => 'admin@cyberpharma.co'],
            [
                'nombre' => 'Michelle',
                'apellido' => 'Quiroz',
                'password' => 'Admin#2025', // El modelo lo encripta
                'edad' => '30',
                'fecha_ingreso' => now()
            ]
        );

        // --- 5. ASIGNA EL ROL DE SUPER-ADMIN AL USUARIO ---
        $user->assignRole($superAdminRole);
    }
}
