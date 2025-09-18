<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear productos de prueba
        \App\Models\Product::create([
            'sku' => 'PRD-001',
            'nombre' => 'Laptop HP ProBook',
            'descripcion_corta' => 'Laptop profesional para oficina',
            'descripcion_larga' => 'Laptop HP ProBook con procesador Intel Core i5, 8GB RAM, 256GB SSD.',
            'imagen_url' => 'https://example.com/laptop.jpg',
            'precio_neto' => 500000,
            'precio_venta' => 595000,
            'stock_actual' => 15,
            'stock_minimo' => 5,
            'stock_bajo' => 10,
            'stock_alto' => 50,
        ]);

        \App\Models\Product::create([
            'sku' => 'PRD-002',
            'nombre' => 'Mouse Inalámbrico',
            'descripcion_corta' => 'Mouse inalámbrico ergonómico',
            'descripcion_larga' => 'Mouse inalámbrico con tecnología Bluetooth y batería de larga duración.',
            'imagen_url' => 'https://example.com/mouse.jpg',
            'precio_neto' => 15000,
            'precio_venta' => 17850,
            'stock_actual' => 3,
            'stock_minimo' => 10,
            'stock_bajo' => 5,
            'stock_alto' => 100,
        ]);

        // Crear clientes de prueba
        \App\Models\Client::create([
            'rut_empresa' => '76543210-K',
            'rubro' => 'Tecnología',
            'razon_social' => 'TechCorp Ltda.',
            'telefono' => '+56 2 2345 6789',
            'direccion' => 'Av. Las Condes 123, Las Condes, Santiago',
            'nombre_contacto' => 'Juan Pérez',
            'email_contacto' => 'juan.perez@techcorp.cl',
        ]);

        \App\Models\Client::create([
            'rut_empresa' => '87654321-9',
            'rubro' => 'Servicios',
            'razon_social' => 'Servicios Integrales S.A.',
            'telefono' => '+56 2 2987 6543',
            'direccion' => 'Calle Principal 456, Providencia, Santiago',
            'nombre_contacto' => 'María González',
            'email_contacto' => 'maria.gonzalez@servicios.cl',
        ]);

        // Crear usuarios adicionales
        \App\Models\User::create([
            'name' => 'Carlos Rodríguez',
            'rut' => '11111111-1',
            'nombre' => 'Carlos',
            'apellido' => 'Rodríguez',
            'email' => 'carlos.rodriguez@ventasfix.cl',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
