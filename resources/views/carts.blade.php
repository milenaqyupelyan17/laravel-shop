@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">Homepage</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row align-items-start flex gap-20">
        <section id="account" class="w-20" style="min-height: 100vh;">
            <div class="wrapper bg-grey" style="min-height: 100vh;">
                <div class="flex flex-column gap-20" style="padding: 30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <form action="{{ route('dashboard') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </button>
                    </form>
                    <form action="{{ url('settings') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->is('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </button>
                    </form>
                    <form action="{{ route('carts') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Cards
                        </button>
                    </form>
                    <form action="{{ route('favorites') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </button>
                    </form>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section id="cart-table" style="width: 80%;">
            <div class="wrapper">
                <div class="title-3 w-700">Shopping Cart</div>
                <div class="wrapper bg-grey br">
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th class="title-6 text-left">Product</th>
                                    <th class="title-6">Quantity</th>
                                    <th class="title-6">Color</th>
                                    <th class="title-6">Size</th>
                                    <th class="title-6">Price</th>
                                    <th class="title-6">Orders</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="padding:20px 10px;">
                                        <div class="flex align-items-center gap-10">
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->title }}"
                                                style=" width:70px; height:90px; object-fit:cover;">
                                            <div>
                                                <div class="title-6 w-700">
                                                    {{ $item->product->title }}
                                                </div>
                                                <div class="text-grey title-7">
                                                    Order #{{ $order->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:20px 10px;">
                                        <span class="title-6">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td style="padding:20px 10px;">
                                        <span class="title-6">
                                            {{ $item->color ?? 'Default' }}
                                        </span>
                                    </td>
                                    <td style="padding:20px 10px;">
                                        <span class="title-6">
                                            {{ $item->size ?? 'Default' }}
                                        </span>
                                    </td>
                                    <td style="padding:20px 10px;">
                                        <span class="title-6 w-700">
                                            ${{ number_format($item->price * $item->quantity, 2) }}
                                        </span>
                                    </td>
                                    <td style="padding:20px 10px;">
                                        <span class="title-6">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding:50px;">
                                        <div class="title-4">
                                            No orders yet
                                        </div>
                                        <p class="text-grey title-6">
                                            You haven't purchased any products yet.
                                        </p>
                                        <a href="{{ route('products') }}" class="btn-1">
                                            Continue Shopping
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="empty-cart" class="wrapper text-center flex flex-column align-items-center"
                    style="display:none;">
                    <div class="flex flex-column gap-20">
                        <div class="title-4">Your cart is empty</div>
                        <p class="text-grey title-6">Add some products to your cart.</p>
                        <a href="{{ route('products') }}" class="btn-1">Continue Shopping</a>
                    </div>
                </div>
                <div class="flex justify-content-end">
                    <div class="title-5 w-700" style="padding: 20px;">
                        Total:
                        <span class="text-red">
                            ${{ number_format($orders->sum('total_price'), 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection