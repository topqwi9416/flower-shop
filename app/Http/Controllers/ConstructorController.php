<?php
namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    // Страница конструктора букетов
    public function index()
    {
        $flowers = Flower::where('stock', '>', 0)->get();
        return view('constructor.index', compact('flowers'));
    }

    // Расчёт стоимости букета
    public function calculate(Request $request)
    {
        $items = $request->input('flowers', []);
        $total = 0;
        $selected = [];

        foreach ($items as $flower_id => $quantity) {
            if ($quantity > 0) {
                $flower = Flower::find($flower_id);
                if ($flower) {
                    $subtotal = $flower->price * $quantity;
                    $total += $subtotal;
                    $selected[] = [
                        'flower' => $flower,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        return response()->json([
            'total' => $total,
            'selected' => $selected,
        ]);
    }
}