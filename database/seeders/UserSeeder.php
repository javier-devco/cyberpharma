<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Datos de los usuarios a crear
        $usersData = [
            [
                'nombre' => 'Michelle',
                'apellido' => 'Quiroz',
                'email' => 'admin@cyberpharma.co',
                'password' => 'Admin#2025',
                'role' => 'Administrador',
            ],
            [
                'nombre' => 'Pablo',
                'apellido' => 'Escobar',
                'email' => 'regente@cyberpharma.co',
                'password' => 'Regente#25',
                'role' => 'Regente',
            ],
            [
                'nombre' => 'Julian',
                'apellido' => 'Fonseca',
                'email' => 'bodega@cyberpharma.co',
                'password' => 'Bodega#25',
                'role' => 'Bodega',
            ],
            [
                'nombre' => 'Paola',
                'apellido' => 'Mendez',
                'email' => 'ventas@cyberpharma.co',
                'password' => 'Ventas#25',
                'role' => 'Venta',
            ],
        ];

        foreach ($usersData as $data) {
            // 1. Creamos el usuario
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'edad' => '30', // Asumimos una edad por defecto
                    'fecha_ingreso' => now(),
                    'password' => Hash::make($data['password']),
                ]
            );

            // 2. Le asignamos el rol
            $user->assignRole($data['role']);
        }
    }
}
