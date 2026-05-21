@extends('layouts.app')
@section('title', 'Корзина')
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

        .cart-page {
            padding: 40px 0 60px
        }

        .cart-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 32px
        }

        .cart-item {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 20px
        }

        .item-img {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffe0ef, #ffd6eb);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            flex-shrink: 0
        }

        .item-info {
            flex: 1
        }

        .item-name {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px
        }

        .item-price {
            font-size: 14px;
            color: var(--muted)
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .qty-form {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            background: #fff;
            color: var(--accent);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s
        }

        .qty-btn:hover {
            background: var(--accent);
            color: #fff
        }

        .qty-num {
            font-size: 16px;
            font-weight: 700;
            min-width: 28px;
            text-align: center
        }

        .item-total {
            font-size: 17px;
            font-weight: 800;
            color: var(--accent);
            min-width: 90px;
            text-align: right
        }

        .remove-btn {
            background: none;
            border: none;
            color: #ddd;
            font-size: 20px;
            cursor: pointer;
            transition: color .15s;
            padding: 4px
        }

        .remove-btn:hover {
            color: #e84393
        }

        .summary-card {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border);
            position: sticky;
            top: 80px
        }

        .summary-card h2 {
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

        .empty {
            text-align: center;
            padding: 60px;
            color: var(--muted)
        }

        .alert-success {
            background: #fff0f7;
            border: 1px solid var(--accent);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: var(--accent);
            margin-bottom: 20px
        }

        @media(max-width:900px) {
            .cart-grid {
                grid-template-columns: 1fr
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1>🛒 Корзина</h1>
            <p>Ваши выбранные букеты</p>
        </div>
    </div>

    <div class="container">
        <div class="cart-page">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if(empty($cart))
                <div class="empty">
                    <div style="font-size:56px;margin-bottom:16px">🌷</div>
                    <p style="font-size:16px;font-weight:600;margin-bottom:8px">Корзина пуста</p>
                    <p style="margin-bottom:24px">Добавьте букеты из каталога</p>
                    <a href="/catalog" class="btn btn-primary">Перейти в каталог</a>
                </div>
            @else
                <div class="cart-grid">
                    <!-- Список товаров -->
                    <div>
                        @foreach($cart as $id => $item)
                            <div class="cart-item">
                                <img src="/images/bouquets/bouquet_{{ $id }}.jpg"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                                    style="width:80px;height:80px;object-fit:cover;border-radius:12px;flex-shrink:0">
                                <div class="item-img" style="display:none">🌸</div>
                                <div class="item-info">
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    <div class="item-price">{{ number_format($item['price'], 0, '.', ' ') }} ₽ за шт.</div>
                                </div>
                                <div class="item-actions">
                                    <!-- Изменить количество -->
                                    <form method="POST" action="/cart/update" class="qty-form">
                                        @csrf
                                        <input type="hidden" name="bouquet_id" value="{{ $id }}">
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}"
                                            class="qty-btn">−</button>
                                        <span class="qty-num">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                            class="qty-btn">+</button>
                                    </form>
                                    <!-- Сумма -->
                                    <div class="item-total">{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽
                                    </div>
                                    <!-- Удалить -->
                                    <form method="POST" action="/cart/remove">
                                        @csrf
                                        <input type="hidden" name="bouquet_id" value="{{ $id }}">
                                        <button type="submit" class="remove-btn" title="Удалить">✕</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <!-- Очистить корзину -->
                        <form method="POST" action="/cart/clear">
                            @csrf
                            <button type="submit" class="btn btn-outline" style="font-size:13px">🗑 Очистить корзину</button>
                        </form>
                    </div>

                    <!-- Итог -->
                    <div class="summary-card">
                        <h2>📋 Итого</h2>
                        @foreach($cart as $item)
                            <div class="summary-row">
                                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽</span>
                            </div>
                        @endforeach
                        <div class="summary-total">
                            <span class="total-label">Итого:</span>
                            <span class="total-price">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                        </div>
                        <a href="/order/create?from_cart=1" class="btn btn-primary"
                            style="width:100%;justify-content:center;padding:14px;margin-top:20px">
                            Оформить заказ ✅
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection