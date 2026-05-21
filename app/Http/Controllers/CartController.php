<?php
namespace App\Http\Controllers;

use App\Models\Bouquet;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Показать корзину
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    // Добавить в корзину
    public function add(Request $request)
    {
        $bouquet = Bouquet::findOrFail($request->bouquet_id);
        $cart = session()->get('cart', []);
        $id = $bouquet->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                'id'       => $bouquet->id,
                'name'     => $bouquet->name,
                'price'    => $bouquet->price,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '🌸 Букет добавлен в корзину!');
    }

    // Изменить количество
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->bouquet_id;

        if (isset($cart[$id])) {
            if ($request->quantity > 0) {
                $cart[$id]['quantity'] = $request->quantity;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    // Удалить из корзины
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->bouquet_id]);
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    // Очистить корзину
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}