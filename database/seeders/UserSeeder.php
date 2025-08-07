<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $roles = ['SuperAdmin', 'Administrador', 'Regente', 'Bodega', 'Venta'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear usuarios con su rol
        $users = [
            ['name' => 'SuperAdmin', 'email' => 'sadmin@cyberpharma.co', 'password' => 'Sadmin#2025', 'role' => 'SuperAdmin'],
            ['name' => 'Administrador', 'email' => 'admin@cyberpharma.co', 'password' => 'Admin#2025', 'role' => 'Administrador'],
            ['name' => 'Regente', 'email' => 'regente@cyberpharma.co', 'password' => 'Regente#25', 'role' => 'Regente'],
            ['name' => 'Bodega', 'email' => 'bodega@cyberpharma.co', 'password' => 'Bodega#25', 'role' => 'Bodega'],
            ['name' => 'Venta', 'email' => 'ventas@cyberpharma.co', 'password' => 'Ventas#25', 'role' => 'Venta'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            $user->assignRole($userData['role']);
        }
    }
}
