<?php

namespace App\Filament\Resources\Bouquets;

use App\Filament\Resources\Bouquets\Pages\CreateBouquet;
use App\Filament\Resources\Bouquets\Pages\EditBouquet;
use App\Filament\Resources\Bouquets\Pages\ListBouquets;
use App\Filament\Resources\Bouquets\Schemas\BouquetForm;
use App\Filament\Resources\Bouquets\Tables\BouquetsTable;
use App\Models\Bouquet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BouquetResource extends Resource
{
    protected static ?string $navigationLabel = 'Букеты';
    protected static ?string $modelLabel = 'букет';
    protected static ?string $pluralModelLabel = 'Букеты';
    protected static ?string $model = Bouquet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BouquetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BouquetsTable::configure($table);
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
            'index' => ListBouquets::route('/'),
            'create' => CreateBouquet::route('/create'),
            'edit' => EditBouquet::route('/{record}/edit'),
        ];
    }
}
