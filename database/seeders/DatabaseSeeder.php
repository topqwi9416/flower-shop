<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем пользователя только если его нет
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Запускаем наши сидеры
        $this->call([
            CategorySeeder::class,
            BouquetSeeder::class,
        ]);
    }
}