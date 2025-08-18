<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Llama al seeder de Shield que configura TODA la seguridad.
        $this->call(ShieldSeeder::class);

        // 2. Creamos los usuarios de prueba y les asignamos los roles que ShieldSeeder ya creó.

        User::factory()->create([
            'nombre' => 'Carlos',
            'apellido' => 'Ventas',
            'email' => 'vendedor@cyberpharma.co',
            'password' => 'Vendedor#2025',
            'edad' => '25',
            'fecha_ingreso' => now(),
        ])->assignRole('Vendedor');

        User::factory()->create([
            'nombre' => 'Ana',
            'apellido' => 'Bodega',
            'email' => 'bodeguero@cyberpharma.co',
            'password' => 'Bodeguero#2025',
            'edad' => '40',
            'fecha_ingreso' => now(),
        ])->assignRole('Bodeguero');
    }
}
