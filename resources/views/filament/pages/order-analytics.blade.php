<x-filament-panels::page>
    <div style="font-family:inherit">

        {{-- Статистика --}}
        @php $stats = $this->getStats(); @endphp
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px">
            <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;padding:20px;text-align:center">
                <div style="font-size:28px;font-weight:800;color:#e84393">{{ $stats['total_orders'] }}</div>
                <div style="font-size:13px;color:#9ca3af;margin-top:4px">Всего заказов</div>
            </div>
            <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;padding:20px;text-align:center">
                <div style="font-size:28px;font-weight:800;color:#10b981">{{ number_format($stats['total_sum'], 0, '.', ' ') }} ₽</div>
                <div style="font-size:13px;color:#9ca3af;margin-top:4px">Общая сумма</div>
            </div>
            <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;padding:20px;text-align:center">
                <div style="font-size:28px;font-weight:800;color:#3b82f6">{{ number_format($stats['avg_sum'], 0, '.', ' ') }} ₽</div>
                <div style="font-size:13px;color:#9ca3af;margin-top:4px">Средний чек</div>
            </div>
            <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;padding:20px;text-align:center">
                <div style="font-size:28px;font-weight:800;color:#8b5cf6">{{ $stats['delivered'] }}</div>
                <div style="font-size:13px;color:#9ca3af;margin-top:4px">Доставлено</div>
            </div>
        </div>

        {{-- Фильтры --}}
        <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;padding:20px;margin-bottom:20px">
            <div style="font-size:14px;font-weight:700;margin-bottom:16px;color:#f9fafb">🔍 Поиск и фильтры</div>
            <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr 1fr auto;gap:12px;align-items:end">

                {{-- Поиск --}}
                <div>
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;font-weight:600">ПОИСК</div>
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Имя, телефон, адрес..."
                        style="width:100%;padding:8px 12px;border:1px solid #374151;border-radius:8px;font-size:14px;outline:none;background:#111827;color:#f9fafb"
                    >
                </div>

                {{-- Фильтр по клиенту --}}
                <div>
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;font-weight:600">КЛИЕНТ</div>
                    <select wire:model.live="customer_filter"
                        style="width:100%;padding:8px 12px;border:1px solid #374151;border-radius:8px;font-size:14px;outline:none;background:#111827;color:#f9fafb">
                        <option value="">Все клиенты</option>
                        @foreach($this->getCustomers() as $customer)
                            <option value="{{ $customer }}">{{ $customer }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Фильтр по статусу --}}
                <div>
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;font-weight:600">СТАТУС</div>
                    <select wire:model.live="status_filter"
                        style="width:100%;padding:8px 12px;border:1px solid #374151;border-radius:8px;font-size:14px;outline:none;background:#111827;color:#f9fafb">
                        <option value="">Все статусы</option>
                        <option value="new">Новый</option>
                        <option value="confirmed">Подтверждён</option>
                        <option value="delivering">Доставляется</option>
                        <option value="delivered">Доставлен</option>
                        <option value="cancelled">Отменён</option>
                    </select>
                </div>

                {{-- Дата от --}}
                <div>
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;font-weight:600">ДАТА ОТ</div>
                    <input type="date" wire:model.live="date_from"
                        style="width:100%;padding:8px 12px;border:1px solid #374151;border-radius:8px;font-size:14px;outline:none;background:#111827;color:#f9fafb">
                </div>

                {{-- Дата до --}}
                <div>
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;font-weight:600">ДАТА ДО</div>
                    <input type="date" wire:model.live="date_to"
                        style="width:100%;padding:8px 12px;border:1px solid #374151;border-radius:8px;font-size:14px;outline:none;background:#111827;color:#f9fafb">
                </div>

                {{-- Сброс --}}
                <div>
                    <button wire:click="resetFilters"
                        style="padding:8px 16px;background:#374151;border:1px solid #4b5563;border-radius:8px;font-size:13px;cursor:pointer;font-weight:600;color:#f9fafb">
                        Сбросить
                    </button>
                </div>
            </div>
        </div>

        {{-- Таблица --}}
        <div style="background:#1f2937;border:1px solid #374151;border-radius:12px;overflow:hidden">
            <table style="width:100%;border-collapse:collapse;font-size:14px">
                <thead>
                    <tr style="background:#111827;border-bottom:1px solid #374151">
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb;cursor:pointer"
                            wire:click="sortBy('id')">
                            # {{ $sort_field === 'id' ? ($sort_direction === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb;cursor:pointer"
                            wire:click="sortBy('customer_name')">
                            Клиент {{ $sort_field === 'customer_name' ? ($sort_direction === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb">Телефон</th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb;cursor:pointer"
                            wire:click="sortBy('delivery_time')">
                            Доставка {{ $sort_field === 'delivery_time' ? ($sort_direction === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb;cursor:pointer"
                            wire:click="sortBy('total_amount')">
                            Сумма {{ $sort_field === 'total_amount' ? ($sort_direction === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb;cursor:pointer"
                            wire:click="sortBy('status')">
                            Статус {{ $sort_field === 'status' ? ($sort_direction === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#f9fafb">Состав</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->getOrders() as $order)
                    @php
                        $highlight = $search && (
                            str_contains(mb_strtolower($order->customer_name), mb_strtolower($search)) ||
                            str_contains(mb_strtolower($order->customer_phone), mb_strtolower($search)) ||
                            str_contains(mb_strtolower($order->delivery_address), mb_strtolower($search))
                        );
                    @endphp
                    <tr style="border-bottom:1px solid #374151;{{ $highlight ? 'background:#422006' : '' }}">
                        <td style="padding:12px 16px;color:#9ca3af">#{{ $order->id }}</td>
                        <td style="padding:12px 16px;font-weight:600;color:#f9fafb">
                            @if($search && str_contains(mb_strtolower($order->customer_name), mb_strtolower($search)))
                                {!! str_ireplace($search, '<mark style="background:#854d0e;color:#fef3c7;padding:0 2px;border-radius:3px">'.$search.'</mark>', $order->customer_name) !!}
                            @else
                                {{ $order->customer_name }}
                            @endif
                        </td>
                        <td style="padding:12px 16px;color:#9ca3af">{{ $order->customer_phone }}</td>
                        <td style="padding:12px 16px;color:#9ca3af">{{ $order->delivery_time?->format('d.m.Y H:i') }}</td>
                        <td style="padding:12px 16px;font-weight:700;color:#10b981">
                            {{ number_format($order->total_amount, 0, '.', ' ') }} ₽
                        </td>
                        <td style="padding:12px 16px">
                            @php
                                $colors = [
                                    'new'        => '#3b82f6',
                                    'confirmed'  => '#10b981',
                                    'delivering' => '#f59e0b',
                                    'delivered'  => '#8b5cf6',
                                    'cancelled'  => '#ef4444',
                                ];
                                $labels = [
                                    'new'        => 'Новый',
                                    'confirmed'  => 'Подтверждён',
                                    'delivering' => 'Доставляется',
                                    'delivered'  => 'Доставлен',
                                    'cancelled'  => 'Отменён',
                                ];
                                $color = $colors[$order->status] ?? '#6b7280';
                                $label = $labels[$order->status] ?? $order->status;
                            @endphp
                            <span style="background:{{ $color }}30;color:{{ $color }};padding:3px 10px;border-radius:20px;font-size:12px;font-weight:700">
                                {{ $label }}
                            </span>
                        </td>
                        <td style="padding:12px 16px;font-size:12px;color:#9ca3af">
                            @foreach($order->items as $item)
                                🌸 {{ $item->bouquet_name }} × {{ $item->quantity }}<br>
                            @endforeach
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding:40px;text-align:center;color:#9ca3af">
                            Заказы не найдены
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-filament-panels::page>