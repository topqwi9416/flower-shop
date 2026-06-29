<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Розы', 'Тюльпаны', 'Пионы', 'Сборные букеты', 'Комнатные растения'];
        
        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)], // Условие поиска по slug
                ['name' => $name]             // Данные для создания
            );
        }
    }
}