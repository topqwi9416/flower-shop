<?php

namespace App\Filament\Resources\Flowers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FlowerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('color'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('image')
                    ->image(),
            ]);
    }
}
