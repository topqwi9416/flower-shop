<?php
namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Главная страница каталога
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Bouquet::with('category')->where('is_available', true);

        // Фильтр по категории
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Поиск по названию
        if ($request->search) {
            $query->where('name', 'ilike', '%' . $request->search . '%')
                ->orWhere('description', 'ilike', '%' . $request->search . '%');
        }

        $bouquets = $query->get();
        $search = $request->search;

        return view('catalog.index', compact('bouquets', 'categories', 'search'));
    }

    // Страница одного букета
    public function show($id)
    {
        $bouquet = Bouquet::with(['category', 'flowers'])->findOrFail($id);
        return view('catalog.show', compact('bouquet'));
    }
}