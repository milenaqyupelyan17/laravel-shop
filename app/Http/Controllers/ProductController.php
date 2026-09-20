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
        $color = request('color');
        $size = request('size');
        $products = Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($color, function ($query) use ($color) {
                $query->where('color', $color);
            })
            ->when($size, function ($query) use ($size) {
                $query->where('size', $size);
            })
            ->get();

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
