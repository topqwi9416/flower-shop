<?php

namespace App\Filament\Resources\Flowers\Pages;

use App\Filament\Resources\Flowers\FlowerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFlower extends EditRecord
{
    protected static string $resource = FlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
