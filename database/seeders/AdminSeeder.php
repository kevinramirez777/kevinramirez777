<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador inicial
        $admin = User::create([
            'name'      => 'Super Admin',
            'email'     => 'lacayoramirezs@gmail.com',
            'celular'   => '57732543',
            'direccion' => 'Oficina Central',
            'password'  => Hash::make('admin123'), 
        ]);

        // Asignar rol administrador
        $admin->assignRole('admin');
    }
}

