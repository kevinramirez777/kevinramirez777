<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
         // Aquí llamo al seeder de administrador
        $this->call(AdminSeeder::class);

        // Si quiero, puedes llamar otros seeders también:
        // $this->call(ClienteSeeder::class);
        // $this->call(ProductoSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
