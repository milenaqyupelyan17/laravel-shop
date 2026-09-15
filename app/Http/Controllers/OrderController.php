<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'cart' => 'required|string',
        ]);
        $cart = json_decode($request->cart, true);
        if (empty($cart)) {
            return redirect()
                ->route('card')
                ->with('error', 'Your cart is empty.');
        }
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($cart as $product) {
            $price = (float) ($product['price'] ?? 0);
            $quantity = (int) ($product['quantity'] ?? 1);
            $totalPrice += $price * $quantity;
            $totalQuantity += $quantity;
        }
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'total_quantity' => $totalQuantity,
            'status' => 'paid',
        ]);
        foreach ($cart as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'] ?? 1,
                'price' => $product['price'] ?? 0,
                'color' => $product['color'] ?? null,
                'size' => $product['size'] ?? null,
            ]);
        }
        session(['order_id' => $order->id]);

        return redirect()->route('confirmation');
    }
    public function confirmation()
    {
        $orderId = session('order_id');

        if (!$orderId) {
            return redirect()->route('card');
        }

        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        return view('confirmation', compact('order'));
    }
}
