@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('styles')
    <style>
        .page-hero {
            background: linear-gradient(135deg, #ffe0ef, #fff8f8);
            padding: 48px 0;
            text-align: center
        }

        .page-hero h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 8px
        }

        .order-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 32px;
            padding: 40px 0 60px
        }

        .form-card {
            background: #fff;
            border-radius: 20px;
            padding: 32px;
            border: 1px solid var(--border)
        }

        .form-card h2 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 24px
        }

        .form-group {
            margin-bottom: 20px
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 6px
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .15s;
            background: #fff
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--accent)
        }

        textarea {
            resize: vertical;
            min-height: 80px
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 24px 0
        }

        .delivery-info {
            background: #fff0f7;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px
        }

        .delivery-info h3 {
            font-size: 14px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 8px
        }

        .delivery-info p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6
        }

        .order-summary {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border);
            position: sticky;
            top: 80px
        }

        .order-summary h2 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 20px
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border)
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 16px;
            margin-top: 8px
        }

        .total-label {
            font-size: 15px;
            font-weight: 700
        }

        .total-price {
            font-size: 26px;
            font-weight: 800;
            color: var(--accent)
        }

        @media(max-width:900px) {
            .order-grid {
                grid-template-columns: 1fr
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1>🛒 Оформление заказа</h1>
            <p>Доставим ваши цветы точно ко времени</p>
        </div>
    </div>

    <div class="container">
        <div class="order-grid">
            <form method="POST" action="/order">
                @csrf
                @if(request('from_cart'))
                    <input type="hidden" name="from_cart" value="1">
                @endif
                @if(request('bouquet_id'))
                    <input type="hidden" name="bouquet_id" value="{{ request('bouquet_id') }}">
                    <input type="hidden" name="quantity" value="{{ request('quantity', 1) }}">
                @endif
                @if(request('constructor_items'))
                    <input type="hidden" name="constructor_items" value="{{ request('constructor_items') }}">
                @endif

                <div class="form-card" style="margin-bottom:20px">
                    <h2>👤 Данные получателя</h2>
                    <div class="form-group">
                        <label>Имя получателя</label>
                        <input type="text" name="customer_name" placeholder="Иван Иванов" required>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="customer_phone" placeholder="+7 (999) 123-45-67" required>
                    </div>
                </div>

                <div class="form-card" style="margin-bottom:20px">
                    <h2>🚚 Доставка</h2>
                    <div class="delivery-info">
                        <h3>⏰ Доставка ко времени</h3>
                        <p>Укажите точный адрес и желаемое время — мы доставим цветы минута в минуту!</p>
                    </div>
                    <div class="form-group">
                        <label>Адрес доставки</label>
                        <input type="text" name="delivery_address" placeholder="г. Город, ул. Улица, д. 1, кв. 1" required>
                    </div>
                    <div class="form-group">
                        <label>Дата и время доставки</label>
                        <input type="datetime-local" name="delivery_time" required>
                    </div>
                    <div class="form-group">
                        <label>Комментарий к заказу</label>
                        <textarea name="comment" placeholder="Пожелания к букету, как найти вход..."></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"
                    style="width:100%;justify-content:center;padding:16px;font-size:16px">
                    ✅ Оформить заказ
                </button>
            </form>

            <!-- Итог -->
            <div class="order-summary">
                <h2>📋 Ваш заказ</h2>

                @if(request('from_cart'))
                    @php $cart = session()->get('cart', []);
                    $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        <div class="summary-row">
                            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span>{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽</span>
                        </div>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                    <div class="summary-total">
                        <span class="total-label">Итого:</span>
                        <span class="total-price">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>

                @elseif(request('bouquet_id'))
                    @php $bouquet = \App\Models\Bouquet::find(request('bouquet_id')) @endphp
                    @if($bouquet)
                        <div class="summary-row">
                            <span>{{ $bouquet->name }} × {{ request('quantity', 1) }}</span>
                            <span>{{ number_format($bouquet->price * request('quantity', 1), 0, '.', ' ') }} ₽</span>
                        </div>
                        <div class="summary-total">
                            <span class="total-label">Итого:</span>
                            <span class="total-price">{{ number_format($bouquet->price * request('quantity', 1), 0, '.', ' ') }}
                                ₽</span>
                        </div>
                    @endif

                @else
    @if(request('constructor_items'))
        @php
            $items = json_decode(request('constructor_items'), true);
            $constructor_total = 0;
        @endphp
        <div style="font-size:13px;font-weight:700;margin-bottom:12px;color:var(--muted)">💐 Свой букет:</div>
        @foreach($items as $flower_id => $quantity)
            @php $flower = \App\Models\Flower::find($flower_id) @endphp
            @if($flower && $quantity > 0)
                <div class="summary-row">
                    <span>🌷 {{ $flower->name }} × {{ $quantity }}</span>
                    <span>{{ number_format($flower->price * $quantity, 0, '.', ' ') }} ₽</span>
                </div>
                @php $constructor_total += $flower->price * $quantity @endphp
            @endif
        @endforeach
        <div class="summary-total">
            <span class="total-label">Итого:</span>
            <span class="total-price">{{ number_format($constructor_total, 0, '.', ' ') }} ₽</span>
        </div>
    @else
        <p style="color:var(--muted);font-size:13px">Корзина пуста</p>
    @endif
@endif
            </div>
        </div>
    </div>
@endsection