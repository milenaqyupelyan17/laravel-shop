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
        $search = $request->search;
        $products = Product::query();
        if ($search) {
            $products->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $products = $products->orderBy('id', 'asc')->get();
        $recommendedProducts = Product::inRandomOrder()
            ->take(4)
            ->get();

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
