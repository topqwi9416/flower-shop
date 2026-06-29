<?php

namespace App\Filament\Resources\Bouquets\Pages;

use App\Filament\Resources\Bouquets\BouquetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBouquets extends ListRecords
{
    protected static string $resource = BouquetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
