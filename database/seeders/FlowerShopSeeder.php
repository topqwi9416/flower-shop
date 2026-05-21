<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Flower;
use App\Models\Bouquet;
use App\Models\BouquetFlower;

class FlowerShopSeeder extends Seeder
{
    public function run(): void
    {
        // Категории
        $categories = [
            ['name' => 'Розы',        'slug' => 'rozy',        'description' => 'Классические букеты из роз'],
            ['name' => 'Тюльпаны',    'slug' => 'tyulpany',    'description' => 'Нежные весенние тюльпаны'],
            ['name' => 'Пионы',       'slug' => 'piony',       'description' => 'Роскошные пионы'],
            ['name' => 'Смешанные',   'slug' => 'smeshannye',  'description' => 'Сборные букеты'],
            ['name' => 'Свадебные',   'slug' => 'svadebnye',   'description' => 'Букеты для свадьбы'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Цветы
        $flowers = [
            ['name' => 'Роза красная',    'color' => 'Красный',   'price' => 150, 'stock' => 100],
            ['name' => 'Роза белая',      'color' => 'Белый',     'price' => 150, 'stock' => 80],
            ['name' => 'Роза розовая',    'color' => 'Розовый',   'price' => 150, 'stock' => 90],
            ['name' => 'Роза жёлтая',     'color' => 'Жёлтый',    'price' => 140, 'stock' => 70],
            ['name' => 'Тюльпан красный', 'color' => 'Красный',   'price' => 80,  'stock' => 120],
            ['name' => 'Тюльпан белый',   'color' => 'Белый',     'price' => 80,  'stock' => 100],
            ['name' => 'Тюльпан жёлтый',  'color' => 'Жёлтый',   'price' => 80,  'stock' => 90],
            ['name' => 'Тюльпан розовый', 'color' => 'Розовый',   'price' => 85,  'stock' => 110],
            ['name' => 'Пион розовый',    'color' => 'Розовый',   'price' => 200, 'stock' => 50],
            ['name' => 'Пион белый',      'color' => 'Белый',     'price' => 200, 'stock' => 40],
            ['name' => 'Хризантема',      'color' => 'Белый',     'price' => 90,  'stock' => 80],
            ['name' => 'Лилия белая',     'color' => 'Белый',     'price' => 120, 'stock' => 60],
            ['name' => 'Лилия розовая',   'color' => 'Розовый',   'price' => 120, 'stock' => 55],
            ['name' => 'Ромашка',         'color' => 'Белый',     'price' => 50,  'stock' => 150],
            ['name' => 'Подсолнух',       'color' => 'Жёлтый',    'price' => 100, 'stock' => 70],
            ['name' => 'Гвоздика',        'color' => 'Красный',   'price' => 60,  'stock' => 120],
            ['name' => 'Ирис',            'color' => 'Фиолетовый','price' => 90,  'stock' => 65],
            ['name' => 'Нарцисс',         'color' => 'Жёлтый',    'price' => 70,  'stock' => 90],
            ['name' => 'Фрезия',          'color' => 'Розовый',   'price' => 110, 'stock' => 75],
            ['name' => 'Альстромерия',    'color' => 'Оранжевый', 'price' => 85,  'stock' => 85],
        ];

        foreach ($flowers as $f) {
            Flower::create($f);
        }

        // Букеты
        $bouquets = [
            ['category_id' => 1, 'name' => '25 красных роз',      'description' => 'Классический букет из 25 красных роз — символ любви и страсти.',        'price' => 3750],
            ['category_id' => 1, 'name' => '51 белая роза',        'description' => 'Роскошный букет из 51 белоснежной розы для особых случаев.',            'price' => 7650],
            ['category_id' => 1, 'name' => 'Розовый рай',          'description' => 'Нежный букет из розовых и белых роз с зеленью.',                        'price' => 4500],
            ['category_id' => 2, 'name' => '51 тюльпан',           'description' => 'Весенний букет из 51 разноцветного тюльпана.',                          'price' => 4080],
            ['category_id' => 2, 'name' => 'Весенняя нежность',    'description' => 'Смесь белых и розовых тюльпанов — идеально для 8 марта.',               'price' => 2550],
            ['category_id' => 3, 'name' => 'Пионовый бум',         'description' => 'Пышный букет из 15 розовых пионов.',                                    'price' => 3000],
            ['category_id' => 3, 'name' => 'Белые пионы',          'description' => 'Элегантный букет из белых пионов для свадьбы или юбилея.',              'price' => 3200],
            ['category_id' => 4, 'name' => 'Летний микс',          'description' => 'Яркий сборный букет из сезонных цветов.',                               'price' => 2800],
            ['category_id' => 4, 'name' => 'Полевые цветы',        'description' => 'Ромашки, подсолнухи и нарциссы — букет как с луга.',                    'price' => 1800],
            ['category_id' => 4, 'name' => 'Радуга',               'description' => 'Разноцветный букет из роз, тюльпанов и хризантем.',                     'price' => 3200],
            ['category_id' => 5, 'name' => 'Свадебный классик',    'description' => 'Белые розы и пионы — идеальный свадебный букет.',                       'price' => 5500],
            ['category_id' => 5, 'name' => 'Нежная невеста',       'description' => 'Розовые пионы и белые фрезии для незабываемого дня.',                   'price' => 6000],
        ];

        foreach ($bouquets as $b) {
            Bouquet::create($b);
        }

        // Состав букетов
        BouquetFlower::create(['bouquet_id' => 1, 'flower_id' => 1, 'quantity' => 25]);
        BouquetFlower::create(['bouquet_id' => 2, 'flower_id' => 2, 'quantity' => 51]);
        BouquetFlower::create(['bouquet_id' => 3, 'flower_id' => 3, 'quantity' => 20]);
        BouquetFlower::create(['bouquet_id' => 3, 'flower_id' => 2, 'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 4, 'flower_id' => 5, 'quantity' => 17]);
        BouquetFlower::create(['bouquet_id' => 4, 'flower_id' => 6, 'quantity' => 17]);
        BouquetFlower::create(['bouquet_id' => 4, 'flower_id' => 7, 'quantity' => 17]);
        BouquetFlower::create(['bouquet_id' => 5, 'flower_id' => 6, 'quantity' => 25]);
        BouquetFlower::create(['bouquet_id' => 5, 'flower_id' => 8, 'quantity' => 26]);
        BouquetFlower::create(['bouquet_id' => 6, 'flower_id' => 9, 'quantity' => 15]);
        BouquetFlower::create(['bouquet_id' => 7, 'flower_id' => 10,'quantity' => 15]);
        BouquetFlower::create(['bouquet_id' => 8, 'flower_id' => 1, 'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 8, 'flower_id' => 5, 'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 8, 'flower_id' => 11,'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 9, 'flower_id' => 14,'quantity' => 15]);
        BouquetFlower::create(['bouquet_id' => 9, 'flower_id' => 15,'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 9, 'flower_id' => 18,'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 10,'flower_id' => 1, 'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 10,'flower_id' => 5, 'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 10,'flower_id' => 11,'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 11,'flower_id' => 2, 'quantity' => 20]);
        BouquetFlower::create(['bouquet_id' => 11,'flower_id' => 10,'quantity' => 10]);
        BouquetFlower::create(['bouquet_id' => 12,'flower_id' => 9, 'quantity' => 15]);
        BouquetFlower::create(['bouquet_id' => 12,'flower_id' => 19,'quantity' => 10]);
    }
}