@extends('layouts.app')
@section('title', 'Вход')
@section('styles')
<style>
    .auth-page{min-height:70vh;display:flex;align-items:center;justify-content:center;padding:40px 0}
    .auth-card{background:#fff;border-radius:24px;padding:40px;width:100%;max-width:440px;border:1px solid var(--border);box-shadow:0 8px 40px rgba(232,67,147,.08)}
    .auth-title{font-size:26px;font-weight:800;margin-bottom:6px}
    .auth-sub{color:var(--muted);font-size:14px;margin-bottom:28px}
    .form-group{margin-bottom:18px}
    label{display:block;font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px}
    input{width:100%;padding:12px 16px;border:2px solid var(--border);border-radius:12px;font-family:'Manrope',sans-serif;font-size:14px;outline:none;transition:border-color .15s}
    input:focus{border-color:var(--accent)}
    .error{color:#e84393;font-size:13px;margin-top:4px}
    .auth-footer{text-align:center;margin-top:20px;font-size:13px;color:var(--muted)}
    .auth-footer a{color:var(--accent);font-weight:600;text-decoration:none}
</style>
@endsection
@section('content')
<div class="container">
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-title">👋 Вход в аккаунт</div>
            <div class="auth-sub">Войдите чтобы отслеживать заказы</div>

            @if($errors->any())
                <div style="background:#fff0f7;border:1px solid var(--accent);border-radius:10px;padding:12px;margin-bottom:16px;font-size:13px;color:var(--accent)">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.ru" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:15px">
                    Войти
                </button>
            </form>
            <div class="auth-footer">
                Нет аккаунта? <a href="/register">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</div>
@endsection