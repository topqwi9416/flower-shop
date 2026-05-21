@extends('layouts.app')

@section('title', $bouquet->name)

@section('styles')
    <style>
        .product {
            padding: 60px 0
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start
        }

        .product-img {
            width: 100%;
            height: 420px;
            background: linear-gradient(135deg, #ffe0ef, #ffd6eb);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px
        }

        .product-cat {
            font-size: 12px;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 12px
        }

        .product-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px
        }

        .product-desc {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 24px
        }

        .product-price {
            font-size: 36px;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 32px
        }

        .composition {
            background: #fff0f7;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 28px
        }

        .composition h3 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .4px
        }

        .flower-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 13px;
            margin: 4px
        }

        @media(max-width:768px) {
            .product-grid {
                grid-template-columns: 1fr
            }
        }
    </style>
@endsection

@section('content')
    {{-- Хлебные крошки --}}
    <div style="background:#fff;border-bottom:1px solid var(--border);padding:12px 0">
        <div class="container">
            <nav style="font-size:13px;color:var(--muted);display:flex;align-items:center;gap:6px">
                <a href="/" style="color:var(--muted);text-decoration:none">Главная</a>
                <span>›</span>
                <a href="/catalog" style="color:var(--muted);text-decoration:none">Каталог</a>
                <span>›</span>
                @if($bouquet->category)
                    <a href="/catalog?category_id={{ $bouquet->category->id }}"
                        style="color:var(--muted);text-decoration:none">{{ $bouquet->category->name }}</a>
                    <span>›</span>
                @endif
                <span style="color:var(--text);font-weight:600">{{ $bouquet->name }}</span>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="product">
            <div class="product-grid">
                <img src="/images/bouquets/bouquet_{{ $bouquet->id }}.jpg"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                    style="width:100%;height:420px;object-fit:cover;border-radius:24px">
                <div class="product-img" style="display:none">🌸</div>
                <div>
                    <div class="product-cat">{{ $bouquet->category->name ?? '—' }}</div>
                    <div class="product-title">{{ $bouquet->name }}</div>
                    <div class="product-desc">{{ $bouquet->description }}</div>

                    @if($bouquet->flowers->isNotEmpty())
                        <div class="composition">
                            <h3>Состав букета</h3>
                            @foreach($bouquet->flowers as $flower)
                                <span class="flower-tag">🌷 {{ $flower->name }} × {{ $flower->pivot->quantity }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="product-price">{{ number_format($bouquet->price, 0, '.', ' ') }} ₽</div>

                    <a href="/order/create?bouquet_id={{ $bouquet->id }}&quantity=1" class="btn btn-primary"
                        style="width:100%;justify-content:center;padding:16px">
                        🛒 Заказать с доставкой
                    </a>
                    <a href="/catalog" class="btn btn-outline"
                        style="width:100%;justify-content:center;padding:14px;margin-top:12px">
                        ← Вернуться в каталог
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection