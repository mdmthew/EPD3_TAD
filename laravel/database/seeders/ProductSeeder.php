<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::updateOrCreate(
            ['name' => 'Guía de Roma'],
            [
            'description' => 'Guía turística completa para visitar Roma en 3 días.',
            'price' => 14.99,
            'stock' => 20,
            'image' => 'roma.jpg',
            'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Guía de París'],
            [
            'description' => 'Ruta turística por los lugares más importantes de París.',
            'price' => 12.99,
            'stock' => 15,
            'image' => 'paris.jpg',
            'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Guía de Nueva York'],
            [
            'description' => 'Guía para descubrir Nueva York por barrios y zonas.',
            'price' => 18.99,
            'stock' => 10,
            'image' => 'nueva-york.jpg',
            'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Guía de Tokio'],
            [
            'description' => 'Guía práctica para viajar a Tokio por primera vez.',
            'price' => 16.50,
            'stock' => 12,
            'image' => 'tokio.jpg',
            'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Guía de Marrakech'],
            [
            'description' => 'Guía para visitar Marrakech, sus zocos y principales monumentos.',
            'price' => 10.99,
            'stock' => 18,
            'image' => 'marrakech.jpg',
            'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Guía de Londres'],
            [
            'description' => 'Guía urbana para recorrer Londres en pocos días.',
            'price' => 13.99,
            'stock' => 25,
            'image' => 'londres.jpg',
            'is_active' => true,
            ]
        );
    }
}