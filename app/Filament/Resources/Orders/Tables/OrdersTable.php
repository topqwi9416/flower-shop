<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('customer_name')
                    ->label('Клиент')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_phone')
                    ->label('Телефон'),

                TextColumn::make('delivery_time')
                    ->label('Время доставки')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Сумма')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn($state) => match($state) {
                        'new'        => 'Новый',
                        'confirmed'  => 'Подтверждён',
                        'delivering' => 'Доставляется',
                        'delivered'  => 'Доставлен',
                        'cancelled'  => 'Отменён',
                        default      => $state,
                    })
                    ->color(fn($state) => match($state) {
                        'new'        => 'info',
                        'confirmed'  => 'success',
                        'delivering' => 'warning',
                        'delivered'  => 'primary',
                        'cancelled'  => 'danger',
                        default      => 'gray',
                    }),
            ])
            ->recordActions([
                EditAction::make()->label('Изменить'),
                DeleteAction::make()->label('Удалить'),
            ]);
    }
}