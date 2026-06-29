<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('customer_name')
                ->label('Имя клиента')
                ->required(),

            TextInput::make('customer_phone')
                ->label('Телефон')
                ->required(),

            TextInput::make('delivery_address')
                ->label('Адрес доставки')
                ->required(),

            DateTimePicker::make('delivery_time')
                ->label('Время доставки')
                ->required(),

            Select::make('status')
                ->label('Статус')
                ->options([
                    'new'        => 'Новый',
                    'confirmed'  => 'Подтверждён',
                    'delivering' => 'Доставляется',
                    'delivered'  => 'Доставлен',
                    'cancelled'  => 'Отменён',
                ])
                ->required(),

            TextInput::make('total_amount')
                ->label('Сумма заказа')
                ->numeric()
                ->disabled(),

            Textarea::make('comment')
                ->label('Комментарий')
                ->nullable(),
        ]);
    }
}
