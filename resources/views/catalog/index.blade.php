@extends('layouts.app')

@section('title', 'Каталог букетов')

@section('styles')
    <style>
        .hero {
            background: linear-gradient(135deg, #ffe0ef, #fff8f8);
            padding: 60px 0;
            text-align: center
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 12px
        }

        .hero p {
            color: var(--muted);
            font-size: 16px
        }

        .filters {
            padding: 32px 0 16px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 50px;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--muted);
            font-family: 'Manrope', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .15s
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--accent);
            color: var(--accent);
            background: #fff0f7
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            padding: 24px 0 60px
        }

        .card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            transition: transform .2s, box-shadow .2s
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(232, 67, 147, .15)
        }

        .card-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, #ffe0ef, #ffd6eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px
        }

        .card-body {
            padding: 20px
        }

        .card-cat {
            font-size: 11px;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px
        }

        .card-desc {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 16px;
            line-height: 1.5
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .price {
            font-size: 20px;
            font-weight: 800;
            color: var(--accent);
            white-space: nowrap
        }

        .empty {
            text-align: center;
            padding: 60px;
            color: var(--muted)
        }
    </style>
@endsection

@section('content')
    <div class="hero">
        <div class="container">
            <h1>🌸 Каталог букетов</h1>
            <p>Свежие цветы с доставкой ко времени</p>
        </div>
    </div>

    <div class="container">

        {{-- Поиск --}}
        <form method="GET" action="/catalog" style="margin-bottom:16px;margin-top:24px">
            @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            @endif
            <div style="display:flex;gap:10px;max-width:480px">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="🔍 Найти букет..."
                    style="flex:1;padding:10px 16px;border:2px solid var(--border);border-radius:50px;font-family:'Manrope',sans-serif;font-size:14px;outline:none;transition:border-color .15s"
                    onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                <button type="submit" class="btn btn-primary" style="padding:10px 20px;border-radius:50px">
                    Найти
                </button>
                @if(request('search'))
                    <a href="/catalog" class="btn btn-outline" style="padding:10px 16px;border-radius:50px">✕</a>
                @endif
            </div>
        </form>

        {{-- Результаты поиска --}}
        @if(request('search'))
            <div style="margin-bottom:16px;font-size:14px;color:var(--muted)">
                Результаты по запросу <strong style="color:var(--text)">"{{ request('search') }}"</strong>:
                найдено {{ $bouquets->count() }} букетов
            </div>
        @endif

        <div class="filters">
            <a href="/catalog" class="filter-btn {{ !request('category_id') ? 'active' : '' }}">Все букеты</a>
            @foreach($categories as $cat)
                <a href="/catalog?category_id={{ $cat->id }}"
                    class="filter-btn {{ request('category_id') == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        @if($bouquets->isEmpty())
            <div class="empty">
                <div style="font-size:48px;margin-bottom:16px">🌷</div>
                <p>Букеты пока не добавлены</p>
            </div>
        @else
            <div class="grid">
                @foreach($bouquets as $bouquet)
                    <div class="card">
                        <img src="/images/bouquets/bouquet_{{ $bouquet->id }}.jpg"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                            style="width:100%;height:220px;object-fit:cover">
                        <div class="card-img" style="display:none">🌸</div>
                        <div class="card-body">
                            <div class="card-cat">{{ $bouquet->category->name ?? '—' }}</div>
                            <div class="card-title">{{ $bouquet->name }}</div>
                            <div class="card-desc">{{ Str::limit($bouquet->description, 80) }}</div>
                            <div class="card-footer">
                                <div class="price" style="white-space:nowrap">{{ number_format($bouquet->price, 0, '.', ' ') }} ₽
                                </div>
                                <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
                                    <form method="POST" action="/cart/add">
                                        @csrf
                                        <input type="hidden" name="bouquet_id" value="{{ $bouquet->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary">🛒 В корзину</button>
                                    </form>
                                    <a href="/catalog/{{ $bouquet->id }}" class="btn btn-outline">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection