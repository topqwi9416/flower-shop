@extends('layouts.app')

@section('title', 'Конструктор букетов')

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

        .page-hero p {
            color: var(--muted);
            font-size: 15px
        }

        .constructor {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 32px;
            padding: 40px 0 60px
        }

        .flowers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px
        }

        .flower-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            border: 2px solid var(--border);
            transition: all .2s;
            cursor: pointer
        }

        .flower-card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 16px rgba(232, 67, 147, .1)
        }

        .flower-emoji {
            font-size: 40px;
            margin-bottom: 8px
        }

        .flower-name {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px
        }

        .flower-color {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 8px
        }

        .flower-price {
            font-size: 15px;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 12px
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center
        }

        .qty-btn {
            width: 30px;
            height: 30px;
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
            min-width: 24px;
            text-align: center
        }

        .summary {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border);
            position: sticky;
            top: 80px
        }

        .summary h2 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 20px
        }

        .summary-items {
            min-height: 120px;
            margin-bottom: 20px
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px
        }

        .summary-item:last-child {
            border-bottom: none
        }

        .summary-empty {
            color: var(--muted);
            font-size: 13px;
            text-align: center;
            padding: 20px
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 2px solid var(--border);
            margin-top: 8px
        }

        .total-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted)
        }

        .total-price {
            font-size: 24px;
            font-weight: 800;
            color: var(--accent)
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px
        }

        @media(max-width:900px) {
            .constructor {
                grid-template-columns: 1fr
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1>💐 Конструктор букетов</h1>
            <p>Создай свой уникальный букет из свежих цветов</p>
        </div>
    </div>

    <div class="container">
        <div class="constructor">
            <!-- Список цветов -->
            <div>
                <div class="section-title">Выбери цветы</div>
                <div class="flowers-grid">
                    @foreach($flowers as $flower)
                        <div class="flower-card" id="card-{{ $flower->id }}">
                            <img src="/images/flowers/flower_{{ $flower->id }}.jpg"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                style="width:100%;height:120px;object-fit:cover;border-radius:12px;margin-bottom:8px">
                            <div class="flower-emoji" style="display:none">🌷</div>
                            <div class="flower-name">{{ $flower->name }}</div>
                            <div class="flower-color">{{ $flower->color }}</div>
                            <div class="flower-price">{{ number_format($flower->price, 0) }} ₽/шт</div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty({{ $flower->id }}, {{ $flower->price }}, '{{ $flower->name }}', -1)">−</button>
                                <span class="qty-num" id="qty-{{ $flower->id }}">0</span>
                                <button class="qty-btn"
                                    onclick="changeQty({{ $flower->id }}, {{ $flower->price }}, '{{ $flower->name }}', 1)">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Итог -->
            <div class="summary">
                <h2>🛒 Ваш букет</h2>
                <div class="summary-items" id="summary-items">
                    <div class="summary-empty">Добавьте цветы в букет</div>
                </div>
                <div class="summary-total">
                    <span class="total-label">Итого:</span>
                    <span class="total-price" id="total-price">0 ₽</span>
                </div>
                <form method="GET" action="/order/create" style="margin-top:20px">
                    <input type="hidden" name="constructor_items" id="constructor-input">
                    <button type="submit" onclick="prepareOrder()" class="btn btn-primary"
                        style="width:100%;justify-content:center;padding:14px">
                        Заказать букет 🌸
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const items = {};

        function changeQty(id, price, name, delta) {
            if (!items[id]) items[id] = { qty: 0, price, name };
            items[id].qty = Math.max(0, items[id].qty + delta);
            document.getElementById('qty-' + id).textContent = items[id].qty;
            updateSummary();
        }

        function updateSummary() {
            let total = 0;
            let html = '';
            let hasItems = false;

            for (const id in items) {
                if (items[id].qty > 0) {
                    hasItems = true;
                    const subtotal = items[id].qty * items[id].price;
                    total += subtotal;
                    html += `<div class="summary-item">
                        <span>🌷 ${items[id].name} × ${items[id].qty}</span>
                        <span>${subtotal} ₽</span>
                    </div>`;
                }
            }

            document.getElementById('summary-items').innerHTML = hasItems
                ? html
                : '<div class="summary-empty">Добавьте цветы в букет</div>';
            document.getElementById('total-price').textContent = total + ' ₽';
        }

        function prepareOrder() {
            const data = {};
            for (const id in items) {
                if (items[id].qty > 0) data[id] = items[id].qty;
            }
            document.getElementById('constructor-input').value = JSON.stringify(data);
        }
    </script>
@endsection