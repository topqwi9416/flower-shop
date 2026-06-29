<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

// Главная страница
Route::get('/', function() { return view('home'); })->name('home');

// Каталог букетов
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog.show');

// Конструктор букетов
Route::get('/constructor', [ConstructorController::class, 'index'])->name('constructor.index');
Route::post('/constructor/calculate', [ConstructorController::class, 'calculate'])->name('constructor.calculate');

// Заказы
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

// Авторизация
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// Личный кабинет
Route::get('/profile',  [AuthController::class, 'profile'])->name('profile')->middleware('auth');

// Корзина
Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',      [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',   [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',   [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear',    [CartController::class, 'clear'])->name('cart.clear');

Route::get('/debug-railway', function () {
    return [
        'app' => config('app.env'),
        'url' => config('app.url'),
    ];
});

Route::get('/debug-filament', function () {
    try {
        $panel = \Filament\Facades\Filament::getPanel('admin');
        return [
            'panel_found' => true,
            'panel_path' => $panel->getPath(),
            'panel_id' => $panel->getId(),
        ];
    } catch (\Throwable $e) {
        return [
            'panel_found' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];
    }
});