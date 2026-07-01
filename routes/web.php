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

Route::get('/debug-user-check', function () {
    $user = \App\Models\User::where('email', 'твой@email.com')->first();
    
    if (!$user) {
        return 'Пользователь не найден в БД';
    }
    
    return [
        'user' => $user->toArray(),
        'canAccessPanel' => method_exists($user, 'canAccessPanel') 
            ? $user->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel() ?? \Filament\Facades\Filament::getPanel('admin'))
            : 'метод не определён',
    ];
});

Route::get('/debug-users-list/{secret}', function ($secret) {
    if ($secret !== 'myrender2026xyz') {  // ← твоя произвольная строка
        abort(404);
    }
    
    return \App\Models\User::select('id', 'name', 'email')->get();
});

Route::get('/make-me-admin/{secret}', function ($secret) {
    if ($secret !== 'myrender2026xyz') {
        abort(404);
    }
    
    $user = \App\Models\User::where('email', 'mikh15001@gmail.com')->first();
    
    if (!$user) {
        return 'Пользователь не найден';
    }
    
    $user->is_admin = true;
    $user->save();
    
    return 'Готово, is_admin выставлен для ' . $user->email;
});

Route::get('/debug-check-admin/{secret}', function ($secret) {
    if ($secret !== 'myrender2026xyz') {
        abort(404);
    }
    
    $user = \App\Models\User::find(1);
    return [
        'is_admin' => $user->is_admin,
        'type' => gettype($user->is_admin),
    ];
});

Route::get('/debug-panel-check/{secret}', function ($secret) {
    if ($secret !== 'myrender2026xyz') {
        abort(404);
    }
    
    if (!auth()->check()) {
        return 'НЕ залогинен как веб-пользователь (auth()->check() = false)';
    }
    
    $user = auth()->user();
    $panel = \Filament\Facades\Filament::getPanel('admin');
    
    return [
        'user_id' => $user->id,
        'email' => $user->email,
        'is_admin' => $user->is_admin,
        'canAccessPanel' => $user->canAccessPanel($panel),
    ];
});

Route::get('/debug-routes/{secret}', function ($secret) {
    if ($secret !== 'myrender2026xyz') abort(404);
    
    $routes = collect(\Illuminate\Support\Facades\Route::getRoutes())
        ->filter(fn($r) => str_contains($r->uri(), 'admin'))
        ->map(fn($r) => $r->uri())
        ->values();
    
    return $routes;
});
