<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
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
        // Отключаем Vite ассеты Filament и включаем CDN
        FilamentAsset::register([
            Css::make('app', asset('css/app.css'))->loadedOnRequest(),
        ], 'filament');
    }
}
