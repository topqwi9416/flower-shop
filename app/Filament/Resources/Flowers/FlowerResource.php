<?php

namespace App\Filament\Resources\Flowers;

use App\Filament\Resources\Flowers\Pages\CreateFlower;
use App\Filament\Resources\Flowers\Pages\EditFlower;
use App\Filament\Resources\Flowers\Pages\ListFlowers;
use App\Filament\Resources\Flowers\Schemas\FlowerForm;
use App\Filament\Resources\Flowers\Tables\FlowersTable;
use App\Models\Flower;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FlowerResource extends Resource
{
    protected static ?string $navigationLabel = 'Цветы';
    protected static ?string $modelLabel = 'цветок';
    protected static ?string $pluralModelLabel = 'Цветы';
    protected static ?string $model = Flower::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FlowerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlowersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFlowers::route('/'),
            'create' => CreateFlower::route('/create'),
            'edit' => EditFlower::route('/{record}/edit'),
        ];
    }
}
