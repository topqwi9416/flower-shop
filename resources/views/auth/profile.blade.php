@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('styles')
<style>
    .profile-page{padding:48px 0}
    .profile-header{background:linear-gradient(135deg,#ffe0ef,#fff8f8);border-radius:24px;padding:32px;margin-bottom:32px;display:flex;align-items:center;gap:24px}
    .avatar{width:72px;height:72px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;font-weight:800;flex-shrink:0}
    .profile-name{font-size:22px;font-weight:800}
    .profile-email{color:var(--muted);font-size:14px;margin-top:4px}
    .section-title{font-size:20px;font-weight:800;margin-bottom:20px}
    .order-card{background:#fff;border-radius:16px;padding:20px;border:1px solid var(--border);margin-bottom:16px}
    .order-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
    .order-num{font-size:15px;font-weight:700}
    .order-date{font-size:13px;color:var(--muted)}
    .status{padding:4px 12px;border-radius:50px;font-size:12px;font-weight:700}
    .status-new{background:#fff0f7;color:var(--accent)}
    .status-confirmed{background:#e6f7ee;color:#2d8a4e}
    .status-delivering{background:#fff8e6;color:#b07d00}
    .status-delivered{background:#e6f7ee;color:#2d8a4e}
    .status-cancelled{background:#ffe6e6;color:#c0392b}
    .order-items{font-size:13px;color:var(--muted);margin-bottom:12px}
    .order-total{font-size:18px;font-weight:800;color:var(--accent)}
    .order-delivery{font-size:13px;color:var(--muted);margin-top:6px}
    .empty{text-align:center;padding:60px;color:var(--muted)}
</style>
@endsection
@section('content')
<div class="container">
    <div class="profile-page">
        <div class="profile-header">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-email">{{ Auth::user()->email }}</div>
            </div>
            <form method="POST" action="/logout" style="margin-left:auto">
                @csrf
                <button type="submit" class="btn btn-outline">Выйти</button>
            </form>
        </div>

        <div class="section-title">📦 Мои заказы</div>

        @if($orders->isEmpty())
            <div class="empty">
                <div style="font-size:48px;margin-bottom:16px">🌷</div>
                <p>У вас пока нет заказов</p>
                <a href="/catalog" class="btn btn-primary" style="margin-top:16px">Перейти в каталог</a>
            </div>
        @else
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-head">
                    <div class="order-num">Заказ #{{ $order->id }}</div>
                    <span class="status status-{{ $order->status }}">
                        @if($order->status == 'new') Новый
                        @elseif($order->status == 'confirmed') Подтверждён
                        @elseif($order->status == 'delivering') Доставляется
                        @elseif($order->status == 'delivered') Доставлен
                        @else Отменён @endif
                    </span>
                </div>
                <div class="order-items">
                    @foreach($order->items as $item)
                        🌸 {{ $item->bouquet_name }} × {{ $item->quantity }}<br>
                    @endforeach
                </div>
                <div class="order-total">{{ number_format($order->total_amount, 0, '.', ' ') }} ₽</div>
                <div class="order-delivery">
                    🚚 {{ $order->delivery_address }}<br>
                    ⏰ {{ $order->delivery_time->format('d.m.Y в H:i') }}
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection