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

        // Crear productos
        $productos = [
            ['nombre' => 'Televisor LED 55" 4K', 'precio' => 899.99, 'marca_id' => 1],
            ['nombre' => 'Smartphone Galaxy S23', 'precio' => 1099.99, 'marca_id' => 2],
            ['nombre' => 'Refrigerador Side by Side', 'precio' => 1599.99, 'marca_id' => 3],
            ['nombre' => 'Soundbar 5.1 Canales', 'precio' => 349.99, 'marca_id' => 4],
            ['nombre' => 'Cafetera Automática', 'precio' => 129.99, 'marca_id' => 5],
            ['nombre' => 'Smartwatch Mi Band 7', 'precio' => 79.99, 'marca_id' => 6],
            ['nombre' => 'iPhone 15 Pro', 'precio' => 1299.99, 'marca_id' => 7],
            ['nombre' => 'Laptop EliteBook', 'precio' => 1399.99, 'marca_id' => 8],
            ['nombre' => 'Monitor 27" 4K', 'precio' => 499.99, 'marca_id' => 9],
            ['nombre' => 'Tablet ZenPad', 'precio' => 299.99, 'marca_id' => 10]
        ];

        Producto::insert($productos);
    }
}