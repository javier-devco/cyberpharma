<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- ¡PASO CLAVE! ---
        // Primero, llamamos al seeder que crea todos los roles y permisos.
        // Esto es esencial para que podamos asignar el rol de Administrador al usuario.
        $this->call(PermissionSeeder::class);

        // Ahora, creamos el usuario administrador
        $adminUser = User::factory()->create([
            'nombre' => 'Michelle',
            'apellido' => 'Quiroz',
            'edad' => '30',
            'fecha_ingreso' => now(),
            'email' => 'admin@cyberpharma.co',
            'password' => Hash::make('Admin#2025'),
        ]);

        // Y le asignamos el rol que ya existe gracias al PermissionSeeder.
        $adminUser->assignRole('Administrador');

        // (Opcional) Puedes añadir aquí la creación de otros datos ficticios
        // si lo necesitas, pero por ahora lo mantenemos limpio para asegurar que funcione.
    }
}
