<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::take(4)->get();
        $mustHaveProducts = Product::whereIn('id', [11, 12, 13])->get();
        return view('home', compact('products', 'mustHaveProducts'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        $products = $query
            ->orderBy('id', 'asc')
            ->get();

        $recommendedProducts = Product::take(4)->get();

        return view('products', compact(
            'products',
            'recommendedProducts'
        ));
    }

    public function categories()
    {
        $products = Product::all();
        return view('categories', compact('products'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $recommendedProducts = Product::where('id', '!=', $product->id)
            ->whereNotIn('id', Product::orderBy('id', 'desc')->take(3)->pluck('id'))
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('productdetails', [
            'product' => $product,
            'recommendedProducts' => $recommendedProducts
        ]);
    }
}
