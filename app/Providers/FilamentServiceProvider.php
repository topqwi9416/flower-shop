<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Указываем Filament использовать CDN для ассетов
        FilamentAsset::register([
            // Здесь можно добавить кастомные CSS, если нужно
        ]);
    }
}
