@extends('layouts.app')

@section('title', 'Заказ оформлен!')

@section('styles')
<style>
    .success-page{min-height:70vh;display:flex;align-items:center;justify-content:center;padding:60px 0}
    .success-card{background:#fff;border-radius:24px;padding:48px;text-align:center;max-width:560px;width:100%;border:1px solid var(--border);box-shadow:0 8px 40px rgba(232,67,147,.1)}
    .success-icon{font-size:72px;margin-bottom:24px}
    .success-title{font-size:28px;font-weight:800;margin-bottom:8px}
    .success-sub{color:var(--muted);font-size:15px;margin-bottom:32px;line-height:1.6}
    .order-details{background:#fff0f7;border-radius:16px;padding:20px;text-align:left;margin-bottom:28px}
    .detail-row{display:flex;justify-content:space-between;font-size:14px;padding:6px 0;border-bottom:1px solid rgba(232,67,147,.1)}
    .detail-row:last-child{border-bottom:none}
    .detail-label{color:var(--muted);font-weight:600}
    .detail-value{font-weight:700}
    .btn-group{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
</style>
@endsection

@section('content')
<div class="container">
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon">🌸</div>
            <div class="success-title">Заказ оформлен!</div>
            <p class="success-sub">Спасибо за ваш заказ! Мы свяжемся с вами в ближайшее время для подтверждения.</p>

            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Номер заказа</span>
                    <span class="detail-value">#{{ $order->id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Получатель</span>
                    <span class="detail-value">{{ $order->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Телефон</span>
                    <span class="detail-value">{{ $order->customer_phone }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Адрес</span>
                    <span class="detail-value">{{ $order->delivery_address }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Время доставки</span>
                    <span class="detail-value">{{ $order->delivery_time->format('d.m.Y в H:i') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Сумма заказа</span>
                    <span class="detail-value" style="color:var(--accent)">{{ number_format($order->total_amount, 0) }} ₽</span>
                </div>
            </div>

            <div class="btn-group">
                <a href="/catalog" class="btn btn-primary">🌸 В каталог</a>
                <a href="/" class="btn btn-outline">На главную</a>
            </div>
        </div>
    </div>
</div>
@endsection