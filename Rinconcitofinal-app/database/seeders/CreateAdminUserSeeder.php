<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Verificar si ya existe un usuario admin
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@rinconcito.com',
                'password' => Hash::make('Admin1234'), // Cambia la contraseña por una segura
                'role' => 'admin',
            ]);
        }
    }
}
