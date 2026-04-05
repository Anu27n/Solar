<?php

namespace App\Http\Controllers;

use App\Models\SolarProduct;
use Illuminate\Http\Request;

class SolarProductController extends Controller
{
    public function index(Request $request)
    {
        $query = SolarProduct::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->orderBy('name')->paginate(12)->withQueryString();
        
        // Fetch categories for the filter UI
        $categories = SolarProduct::select('category')->whereNotNull('category')->distinct()->pluck('category');

        return view('solar.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = SolarProduct::findOrFail($id);
        return view('solar.show', compact('product'));
    }
}
