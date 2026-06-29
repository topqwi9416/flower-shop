<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bouquet;
use App\Models\Category;

class BouquetSeeder extends Seeder
{
    public function run(): void
    {
        $bouquets = [
            ['name' => 'Нежность розы', 'price' => 3500, 'category' => 'Розы', 'description' => 'Букет из 25 розовых роз'],
            ['name' => 'Весенний тюльпан', 'price' => 2800, 'category' => 'Тюльпаны', 'description' => 'Яркий букет из 35 тюльпанов'],
            ['name' => 'Пионовый рай', 'price' => 5200, 'category' => 'Пионы', 'description' => 'Роскошный букет из 15 пионов'],
            ['name' => 'Летнее настроение', 'price' => 4100, 'category' => 'Сборные букеты', 'description' => 'Сборный букет из сезонных цветов'],
            ['name' => 'Фиалка в горшке', 'price' => 1200, 'category' => 'Комнатные растения', 'description' => 'Красивая фиалка'],
        ];

        foreach ($bouquets as $data) {
            $category = Category::where('name', $data['category'])->first();
            
            Bouquet::firstOrCreate(
                ['name' => $data['name']],
                [
                    'category_id' => $category?->id,
                    'price' => $data['price'],
                    'description' => $data['description'],
                    'is_available' => true, // ВАЖНО: должно быть true!
                ]
            );
        }
    }
}