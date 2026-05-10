<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryGroup;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CONTINENTES
        |--------------------------------------------------------------------------
        */

        $continents = CategoryGroup::create([
            'name' => 'Continentes',
            'slug' => 'continentes',
        ]);

        $continentCategories = [
            'Europa',
            'Asia',
            'África',
            'América',
            'Oceanía',
        ];

        foreach ($continentCategories as $name) {
            Category::create([
                'category_group_id' => $continents->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PAISAJE
        |--------------------------------------------------------------------------
        */

        $landscape = CategoryGroup::create([
            'name' => 'Paisaje',
            'slug' => 'paisaje',
        ]);

        $landscapeCategories = [
            'Montaña',
            'Playa',
            'Selva',
            'Ciudad',
            'Animal',
        ];

        foreach ($landscapeCategories as $name) {
            Category::create([
                'category_group_id' => $landscape->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DURACIÓN
        |--------------------------------------------------------------------------
        */

        $duration = CategoryGroup::create([
            'name' => 'Duración',
            'slug' => 'duracion',
        ]);

        $durationCategories = [
            'Menos de 1 semana',
            '7 a 15 días',
            '15 a 20 días',
            'Más de 20 días',
        ];

        foreach ($durationCategories as $name) {
            Category::create([
                'category_group_id' => $duration->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PRECIO GUÍA
        |--------------------------------------------------------------------------
        */

        $guidePrice = CategoryGroup::create([
            'name' => 'Precio guía',
            'slug' => 'precio-guia',
        ]);

        $guidePriceCategories = [
            'Menos de 5€',
            '5€ a 10€',
            '10€ a 15€',
            '15€ a 20€',
        ];

        foreach ($guidePriceCategories as $name) {
            Category::create([
                'category_group_id' => $guidePrice->id,
                'name' => $name,
                'slug' => Str::slug(str_replace('€', ' euros', $name)),
            ]);
        }
    }
}