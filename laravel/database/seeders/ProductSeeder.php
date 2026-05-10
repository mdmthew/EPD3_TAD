<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roma = Product::updateOrCreate(
            ['name' => 'Guía de Roma'],
            [
            'description' => 'Guía turística completa para visitar Roma en 3 días.',
            'price' => 9.50,
            'stock' => 20,
            'image' => 'img/roma.jpg',
            'is_active' => true,
            'travel_price_level' => 2,
            ]
        );

        $roma->categories()->attach([
            Category::where('slug', 'europa')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', 'menos-de-1-semana')->first()->id,
            Category::where('slug', '5-euros-a-10-euros')->first()->id,
        ]);


        $bali = Product::updateOrCreate(
            ['name' => 'Guía de Bali'],
            [
            'description' => 'Guía completa original para unas vacaciones en Bali.',
            'price' => 8.99,
            'stock' => 15,
            'image' => 'img/bali.jpg',
            'is_active' => true,
            'travel_price_level' => 2,
            ]
        );

        $bali->categories()->attach([
            Category::where('slug', 'asia')->first()->id,
            Category::where('slug', 'playa')->first()->id,
            Category::where('slug', 'selva')->first()->id,
            Category::where('slug', '7-a-15-dias')->first()->id,
            Category::where('slug', '5-euros-a-10-euros')->first()->id,
        ]);


        $paris = Product::updateOrCreate(
            ['name' => 'Guía de París'],
            [
            'description' => 'Ruta turística por los lugares más importantes de París.',
            'price' => 12.99,
            'stock' => 15,
            'image' => 'img/paris.jpg',
            'is_active' => true,
            'travel_price_level' => 3,
            ]
        );
        $paris->categories()->attach([
            Category::where('slug', 'europa')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', 'menos-de-1-semana')->first()->id,
            Category::where('slug', '10-euros-a-15-euros')->first()->id,
        ]);

        $newYork = Product::updateOrCreate(
            ['name' => 'Guía de Nueva York'],
            [
            'description' => 'Guía para descubrir Nueva York por barrios y zonas.',
            'price' => 18.99,
            'stock' => 10,
            'image' => 'img/nueva-york.jpg',
            'is_active' => true,
            'travel_price_level' => 3,
            ]
        );
        $newYork->categories()->attach([
            Category::where('slug', 'america')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', '15-a-20-dias')->first()->id,
            Category::where('slug', '15-euros-a-20-euros')->first()->id,
        ]);

        $tokio = Product::updateOrCreate(
            ['name' => 'Guía de Tokio'],
            [
            'description' => 'Guía práctica para viajar a Tokio por primera vez.',
            'price' => 4.50,
            'stock' => 12,
            'image' => 'img/tokio.jpg',
            'is_active' => true,
            'travel_price_level' => 1,
            ]
        );
        $tokio->categories()->attach([
            Category::where('slug', 'asia')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', 'montana')->first()->id,
            Category::where('slug', 'mas-de-20-dias')->first()->id,
            Category::where('slug', 'menos-de-5-euros')->first()->id,
        ]);

        $marrakech = Product::updateOrCreate(
            ['name' => 'Guía de Marrakech'],
            [
            'description' => 'Guía para visitar Marrakech, sus zocos y principales monumentos.',
            'price' => 3.99,
            'stock' => 18,
            'image' => 'img/marrakech.jpg',
            'is_active' => true,
            'travel_price_level' => 1,
            ]
        );
        $marrakech->categories()->attach([
            Category::where('slug', 'africa')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', 'animal')->first()->id,
            Category::where('slug', 'selva')->first()->id,
            Category::where('slug', 'mas-de-20-dias')->first()->id,
            Category::where('slug', 'menos-de-5-euros')->first()->id,
        ]);

        $londres = Product::updateOrCreate(
            ['name' => 'Guía de Londres'],
            [
            'description' => 'Guía urbana para recorrer Londres en pocos días.',
            'price' => 13.99,
            'stock' => 25,
            'image' => 'img/londres.jpg',
            'is_active' => true,
            'travel_price_level' => 3,
            ]
        );
        $londres->categories()->attach([
            Category::where('slug', 'europa')->first()->id,
            Category::where('slug', 'ciudad')->first()->id,
            Category::where('slug', '7-a-15-dias')->first()->id,
            Category::where('slug', '10-euros-a-15-euros')->first()->id,
        ]);
    }
}