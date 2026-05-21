@extends('layouts.app')

@section('title', 'ЦветокShop — Доставка цветов ко времени')

@section('styles')
<style>
    /* Герой */
    .hero {
        background: linear-gradient(135deg, #ffe0ef 0%, #fff0f7 50%, #fff8f8 100%);
        padding: 80px 0 100px;
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(232,67,147,.12) 0%, transparent 70%);
        border-radius: 50%;
    }
    .hero-inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        position: relative;
        z-index: 1;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(232,67,147,.1);
        border: 1px solid rgba(232,67,147,.2);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 700;
        color: var(--accent);
        margin-bottom: 20px;
    }
    .hero h1 {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-bottom: 20px;
        color: var(--text);
    }
    .hero h1 span { color: var(--accent); }
    .hero-desc {
        font-size: 17px;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 36px;
        max-width: 460px;
    }
    .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
    .hero-img {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 160px;
        filter: drop-shadow(0 20px 40px rgba(232,67,147,.2));
        animation: float 4s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-16px); }
    }

    /* Преимущества */
    .features {
        padding: 80px 0;
        background: #fff;
    }
    .section-title {
        text-align: center;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -.5px;
    }
    .section-sub {
        text-align: center;
        color: var(--muted);
        font-size: 15px;
        margin-bottom: 48px;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    .feature-card {
        background: var(--bg);
        border-radius: 20px;
        padding: 28px 24px;
        text-align: center;
        transition: transform .2s;
    }
    .feature-card:hover { transform: translateY(-4px); }
    .feature-icon {
        font-size: 40px;
        margin-bottom: 16px;
        display: block;
    }
    .feature-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .feature-desc {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    /* Популярные букеты */
    .popular {
        padding: 80px 0;
        background: var(--bg);
    }
    .bouquets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }
    .bouquet-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
        transition: transform .2s, box-shadow .2s;
    }
    .bouquet-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(232,67,147,.15);
    }
    .bouquet-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #ffe0ef, #ffd6eb);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
    }
    .bouquet-body { padding: 18px; }
    .bouquet-cat {
        font-size: 11px;
        font-weight: 700;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 6px;
    }
    .bouquet-name {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .bouquet-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .bouquet-price {
        font-size: 18px;
        font-weight: 800;
        color: var(--accent);
        white-space: nowrap;
    }

    /* Как это работает */
    .how {
        padding: 80px 0;
        background: #fff;
    }
    .steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 32px;
        position: relative;
    }
    .steps::before {
        content: '';
        position: absolute;
        top: 32px;
        left: 10%;
        width: 80%;
        height: 2px;
        background: linear-gradient(90deg, var(--accent), #ff9fd4);
    }
    .step { text-align: center; position: relative; }
    .step-num {
        width: 64px;
        height: 64px;
        background: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 800;
        color: #fff;
        margin: 0 auto 20px;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 24px rgba(232,67,147,.3);
    }
    .step-title {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .step-desc {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    /* CTA */
    .cta {
        background: linear-gradient(135deg, var(--accent), #ff6bb5);
        padding: 80px 0;
        text-align: center;
        color: #fff;
    }
    .cta h2 {
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -.5px;
    }
    .cta p {
        font-size: 16px;
        opacity: .85;
        margin-bottom: 36px;
    }
    .btn-white {
        background: #fff;
        color: var(--accent);
        padding: 14px 36px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all .2s;
        margin: 0 8px;
    }
    .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
    .btn-white-outline {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255,255,255,.6);
        padding: 14px 36px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all .2s;
        margin: 0 8px;
    }
    .btn-white-outline:hover { border-color: #fff; background: rgba(255,255,255,.1); }

    @media(max-width: 900px) {
        .hero-inner { grid-template-columns: 1fr; text-align: center; }
        .hero h1 { font-size: 36px; }
        .hero-img { font-size: 100px; }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
        .steps { grid-template-columns: repeat(2, 1fr); }
        .steps::before { display: none; }
    }
</style>
@endsection

@section('content')

{{-- Герой --}}
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <div>
                <div class="hero-badge">🌸 Свежие цветы каждый день</div>
                <h1>Цветы с доставкой <span>точно ко времени</span></h1>
                <p class="hero-desc">Выбирайте готовые букеты или создайте свой — доставим в любое время, минута в минуту. Идеально для особых моментов!</p>
                <div class="hero-btns">
                    <a href="/catalog" class="btn btn-primary" style="padding:14px 32px;font-size:15px">🌸 Смотреть каталог</a>
                    <a href="/constructor" class="btn btn-outline" style="padding:14px 32px;font-size:15px">💐 Создать букет</a>
                </div>
            </div>
            <div class="hero-img">🌺</div>
        </div>
    </div>
</section>

{{-- Преимущества --}}
<section class="features">
    <div class="container">
        <div class="section-title">Почему выбирают нас</div>
        <p class="section-sub">Мы заботимся о каждом заказе</p>
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">⏰</span>
                <div class="feature-title">Доставка ко времени</div>
                <p class="feature-desc">Укажите точное время — привезём минута в минуту</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🌱</span>
                <div class="feature-title">Свежие цветы</div>
                <p class="feature-desc">Только свежесрезанные цветы с контролем качества</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">💐</span>
                <div class="feature-title">Конструктор букетов</div>
                <p class="feature-desc">Создайте уникальный букет из любимых цветов</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">💳</span>
                <div class="feature-title">Удобная оплата</div>
                <p class="feature-desc">Оплата при получении или онлайн</p>
            </div>
        </div>
    </div>
</section>

{{-- Популярные букеты --}}
<section class="popular">
    <div class="container">
        <div class="section-title">Популярные букеты</div>
        <p class="section-sub">Самые любимые букеты наших клиентов</p>
        <div class="bouquets-grid">
            @foreach(\App\Models\Bouquet::with('category')->where('is_available', true)->take(4)->get() as $bouquet)
            <div class="bouquet-card">
                <img src="/images/bouquets/bouquet_{{ $bouquet->id }}.jpg"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                     style="width:100%;height:200px;object-fit:cover">
                <div class="bouquet-img" style="display:none">🌸</div>
                <div class="bouquet-body">
                    <div class="bouquet-cat">{{ $bouquet->category->name ?? '' }}</div>
                    <div class="bouquet-name">{{ $bouquet->name }}</div>
                    <div class="bouquet-footer">
                        <div class="bouquet-price">{{ number_format($bouquet->price, 0, '.', ' ') }} ₽</div>
                        <form method="POST" action="/cart/add">
                            @csrf
                            <input type="hidden" name="bouquet_id" value="{{ $bouquet->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary" style="padding:8px 18px;font-size:13px">В корзину</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center">
            <a href="/catalog" class="btn btn-outline" style="padding:14px 40px;font-size:15px">Смотреть все букеты →</a>
        </div>
    </div>
</section>

{{-- Как это работает --}}
<section class="how">
    <div class="container">
        <div class="section-title">Как это работает</div>
        <p class="section-sub">Заказать цветы — просто!</p>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <div class="step-title">Выберите букет</div>
                <p class="step-desc">В каталоге или создайте свой в конструкторе</p>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div class="step-title">Добавьте в корзину</div>
                <p class="step-desc">Можно добавить несколько букетов сразу</p>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-title">Укажите время</div>
                <p class="step-desc">Выберите точную дату и время доставки</p>
            </div>
            <div class="step">
                <div class="step-num">4</div>
                <div class="step-title">Получите цветы</div>
                <p class="step-desc">Доставим точно в указанное время!</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta">
    <div class="container">
        <h2>Готовы удивить кого-то? 🌸</h2>
        <p>Закажите букет прямо сейчас и мы доставим радость точно ко времени</p>
        <a href="/catalog" class="btn-white">🌸 Выбрать букет</a>
        <a href="/constructor" class="btn-white-outline">💐 Создать свой</a>
    </div>
</section>

@endsection