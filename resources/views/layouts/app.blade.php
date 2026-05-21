<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="color-scheme" content="light only">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="only light">
    <title>@yield('title', 'Цветочный магазин')</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        html,
        body {
            background: #fff8f8 !important;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        @view-transition {
            navigation: auto;
        }

        :root {
            --bg: #fff8f8;
            --surface: #fff;
            --border: #f0e0e0;
            --accent: #e84393;
            --accent2: #c0306e;
            --text: #2d1a1a;
            --muted: #9e7a7a;
            --card: #fff;
        }

        html {
            background: #fff8f8
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(232, 67, 147, .08)
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: -0.5px
        }

        .logo span {
            color: var(--text)
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
            align-items: center
        }

        .nav-links a {
            text-decoration: none;
            color: var(--muted);
            font-weight: 600;
            font-size: 14px;
            transition: color .15s
        }

        .nav-links a:hover {
            color: var(--accent)
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s
        }

        .btn-primary {
            background: var(--accent);
            color: #fff
        }

        .btn-primary:hover {
            background: var(--accent2);
            transform: translateY(-1px)
        }

        .btn-outline {
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent)
        }

        .btn-outline:hover {
            background: var(--accent);
            color: #fff
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px
        }

        footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 32px 40px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
            margin-top: 60px
        }

        a {
            transition: color .15s ease
        }
    </style>
    @yield('styles')
</head>

<body>
    <nav>
        <a href="/" class="logo">🌸 Цветок<span>Shop</span></a>
        <ul class="nav-links">
            <li><a href="/catalog" style="{{ request()->is('catalog*') ? 'color:var(--accent)' : '' }}">Каталог</a></li>
            <li><a href="/constructor"
                    style="{{ request()->is('constructor*') ? 'color:var(--accent)' : '' }}">Конструктор</a></li>
            <li>
                <a href="/cart" style="position:relative;{{ request()->is('cart*') ? 'color:var(--accent)' : '' }}">
                    🛒 Корзина
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span
                            style="background:var(--accent);color:#fff;border-radius:50%;width:18px;height:18px;font-size:11px;display:inline-flex;align-items:center;justify-content:center;position:absolute;top:-6px;right:-10px;font-weight:700">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </li>
            @auth
                <li><a href="/profile" style="{{ request()->is('profile*') ? 'color:var(--accent)' : '' }}">👤
                        {{ Auth::user()->name }}</a></li>
            @else
                <li><a href="/login" style="{{ request()->is('login*') ? 'color:var(--accent)' : '' }}">Войти</a></li>
                <li><a href="/register"
                        style="{{ request()->is('register*') ? 'color:var(--accent)' : '' }}">Регистрация</a></li>
            @endauth
        </ul>

        @auth
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-outline">Выйти</button>
            </form>
        @else
            <a href="/catalog" class="btn btn-primary">🌸 Каталог</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>🌸 ЦветокShop — доставка цветов ко времени</p>
        <p style="margin-top:8px">📞 +7 (999) 123-45-67 &nbsp;|&nbsp; 📍 г. Город, ул. Цветочная, 1</p>
    </footer>

    @yield('scripts')
</body>

</html>