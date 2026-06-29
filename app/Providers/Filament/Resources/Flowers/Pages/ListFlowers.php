<?php

namespace App\Filament\Resources\Flowers\Pages;

use App\Filament\Resources\Flowers\FlowerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFlowers extends ListRecords
{
    protected static string $resource = FlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
