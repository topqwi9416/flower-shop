<?php

namespace App\Filament\Resources\Flowers\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FlowersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('color')
                    ->label('Цвет')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Остаток')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->label('Изменить'),
                DeleteAction::make()->label('Удалить'),
            ]);
    }
}
