<?php

namespace Database\Seeders;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario de prueba
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@electronica.com',
            'password' => bcrypt('password123')
        ]);

        // Crear marcas
        $marcas = [
            ['nombre' => 'Sony'],
            ['nombre' => 'Samsung'],
            ['nombre' => 'LG'],
            ['nombre' => 'Panasonic'],
            ['nombre' => 'Philips'],
            ['nombre' => 'Xiaomi'],
            ['nombre' => 'Apple'],
            ['nombre' => 'HP'],
            ['nombre' => 'Dell'],
            ['nombre' => 'Asus']
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }

       
    }
}