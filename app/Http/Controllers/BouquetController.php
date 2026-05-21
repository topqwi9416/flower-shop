<?php
namespace App\Http\Controllers;

use App\Models\Bouquet;

class BouquetController extends Controller
{
    public function show($id)
    {
        $bouquet = Bouquet::with(['category', 'flowers'])->findOrFail($id);
        return view('catalog.show', compact('bouquet'));
    }
}