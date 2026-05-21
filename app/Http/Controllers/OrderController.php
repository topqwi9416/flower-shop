<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Bouquet;
use App\Models\Flower;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Страница оформления заказа
    public function create(Request $request)
    {
        return view('order.create');
    }

    // Сохранение заказа
public function store(Request $request)
{
    $request->validate([
        'customer_name'    => 'required|string|max:255',
        'customer_phone'   => 'required|string|max:20',
        'delivery_address' => 'required|string|max:500',
        'delivery_time'    => 'required|date|after:now',
    ]);

    $order = Order::create([
        'user_id'          => auth()->id(),
        'customer_name'    => $request->customer_name,
        'customer_phone'   => $request->customer_phone,
        'delivery_address' => $request->delivery_address,
        'delivery_time'    => $request->delivery_time,
        'comment'          => $request->comment,
        'status'           => 'new',
        'total_amount'     => 0,
    ]);

    $total = 0;

    // Заказ из корзины
    if ($request->from_cart) {
        $cart = session()->get('cart', []);
        foreach ($cart as $bouquet_id => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'bouquet_id'   => $bouquet_id,
                'bouquet_name' => $item['name'],
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
            ]);
            $total += $item['price'] * $item['quantity'];
        }
        session()->forget('cart'); // очищаем корзину после заказа
    }

    // Заказ одного букета
    if ($request->bouquet_id) {
        $bouquet = Bouquet::findOrFail($request->bouquet_id);
        OrderItem::create([
            'order_id'     => $order->id,
            'bouquet_id'   => $bouquet->id,
            'bouquet_name' => $bouquet->name,
            'quantity'     => $request->quantity ?? 1,
            'price'        => $bouquet->price,
        ]);
        $total += $bouquet->price * ($request->quantity ?? 1);
    }

    // Заказ из конструктора
    if ($request->constructor_items) {
        $items = json_decode($request->constructor_items, true);
        $names = [];
        $constructor_total = 0;
        foreach ($items as $flower_id => $quantity) {
            $flower = Flower::find($flower_id);
            if ($flower && $quantity > 0) {
                $names[] = $flower->name . ' x' . $quantity;
                $constructor_total += $flower->price * $quantity;
            }
        }
        if (!empty($names)) {
            OrderItem::create([
                'order_id'     => $order->id,
                'bouquet_id'   => null,
                'bouquet_name' => 'Свой букет: ' . implode(', ', $names),
                'quantity'     => 1,
                'price'        => $constructor_total,
            ]);
            $total += $constructor_total;
        }
    }

    $order->update(['total_amount' => $total]);
    return redirect()->route('order.success', $order->id);
}

    // Страница успешного заказа
    public function success($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('order.success', compact('order'));
    }
}