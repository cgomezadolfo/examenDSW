<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin VentasFix',
            'rut' => '12345678-9',
            'nombre' => 'Admin',
            'apellido' => 'VentasFix',
            'email' => 'admin.ventasfix@ventasfix.cl',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
