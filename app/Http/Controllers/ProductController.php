<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::take(4)->get();

        $mustHaveProducts = Product::whereIn('id', [11, 12, 13])->get();

        return view('home', compact('products', 'mustHaveProducts'));
    }

    public function index()
    {
        $search = request('search');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'asc')
            ->get();

        $products = $products->take($products->count() - 3);

        return view('products', compact('products'));
    }

    public function categories()
    {
        $products = Product::all();

        return view('categories', compact('products'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('productdetails', compact('product'));
    }
}
