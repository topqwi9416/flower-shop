@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('styles')
    <style>
        .error-page {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 0
        }

        .error-card {
            text-align: center;
            max-width: 480px
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: var(--border);
            line-height: 1;
            margin-bottom: 8px
        }

        .error-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 12px
        }

        .error-desc {
            color: var(--muted);
            font-size: 15px;
            margin-bottom: 36px;
            line-height: 1.6
        }

        .error-emoji {
            font-size: 64px;
            margin-bottom: 16px
        }

        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="error-page">
            <div class="error-card">
                <div class="error-emoji">🌷</div>
                <div class="error-code">404</div>
                <div class="error-title">Страница не найдена</div>
                <p class="error-desc">
                    Похоже, этот букет уже забрали или страница переехала.<br>
                    Давайте найдём что-то красивое вместе!
                </p>
                <div class="btn-group">
                    <a href="/catalog" class="btn btn-primary" style="padding:14px 32px;font-size:15px">
                        🌸 В каталог
                    </a>
                    <a href="/" class="btn btn-outline" style="padding:14px 32px;font-size:15px">
                        На главную
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection