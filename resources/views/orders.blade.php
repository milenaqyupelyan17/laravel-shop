@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row align-items-start flex gap-20">
        <section
            id="account"
            class="w-20">
            <div class="wrapper bg-grey">
                <div
                    class="flex flex-column gap-20"
                    style="padding: 30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <div class="flex flex-column gap-20">
                        <a
                            href="{{ route('dashboard') }}"
                            class="title-6 menu-button {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </a>
                        <a
                            href="{{ route('orders') }}"
                            class="title-6 menu-button {{ request()->routeIs('orders') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Orders
                        </a>
                        <a
                            href="{{ route('carts') }}"
                            class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            My Cards
                        </a>
                        <a
                            href="{{ route('favorites') }}"
                            class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </a>
                        <a
                            href="{{ route('settings') }}"
                            class="title-6 menu-button {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                        <form
                            action="{{ route('logout') }}"
                            method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="title-6 menu-button">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section
            id="orders"
            style="width:80%;">
            <div class="wrapper">
                <div class="title-3 w-700">
                    My Orders
                </div>
                @if(session('success'))
                <div
                    class="title-7"
                    style="
                            margin-top:15px;
                            padding:12px 15px;
                            background:#e8f5e9;
                            border-radius:5px;
                        ">
                    {{ session('success') }}
                </div>
                @endif
                @forelse($orders as $order)
                <div
                    class="wrapper bg-grey br"
                    style="
                            margin-top:15px;
                            padding:18px;">
                    <div
                        class="flex justify-content-between align-items-center"
                        style="padding-bottom:12px;">
                        <div>
                            <div class="title-6 w-700">
                                Order #{{ $order->id }}
                            </div>
                            <div class="text-grey title-7">
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                        <div class="title-6 w-700 text-red">
                            ${{ number_format(
                                    $order->total_price,
                                    2
                                ) }}
                        </div>
                    </div>
                    <div
                        style="
                                display:flex;
                                flex-wrap:wrap;
                                gap:12px;
                                padding:12px 0;
                                border-top:1px solid #ddd;">
                        @foreach($order->items as $item)
                        <div
                            style="
                                        width:calc(50% - 6px);
                                        display:flex;
                                        align-items:center;
                                        justify-content:space-between;
                                        gap:10px;">
                            <div
                                class="flex align-items-center gap-10">
                                @if($item->product)
                                <img
                                    src="{{ asset($item->product->image) }}"
                                    alt="{{ $item->product->title }}"
                                    style="
                                                    width:55px;
                                                    height:70px;
                                                    object-fit:contain;
                                                    flex-shrink:0;">
                                @endif
                                <div>
                                    @if($item->product)
                                    <div class="title-7 w-700">
                                        {{ $item->product->title }}
                                    </div>
                                    @endif
                                    <div class="text-grey title-7">
                                        Qty: {{ $item->quantity }}
                                    </div>
                                    <div class="text-grey title-7">
                                        Color:
                                        {{ $item->color ?? 'Not selected' }}
                                    </div>
                                    <div class="text-grey title-7">
                                        Size:
                                        {{ $item->size ?? 'Not selected' }}
                                    </div>
                                </div>
                            </div>
                            <div class="title-7 w-700">
                                ${{ number_format(
                                            $item->price * $item->quantity,
                                            2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div
                        class="flex justify-content-between"
                        style="
                                padding-top:12px;
                                margin-top:5px;
                                border-top:1px solid #ddd;">
                        <div class="title-7 w-700">
                            Total Quantity:
                        </div>
                        <div class="title-7">
                            {{ $order->total_quantity }}
                        </div>
                    </div>
                    <div
                        class="flex justify-content-between"
                        style="
                                padding-top:6px;">
                        <div class="title-7 w-700">
                            Total Price:
                        </div>
                        <div class="title-7 w-700 text-red">
                            ${{ number_format(
                                    $order->total_price,
                                    2
                                ) }}
                        </div>
                    </div>
                    <div
                        class="flex justify-content-between align-items-center"
                        style="
                                padding-top:12px;
                                margin-top:10px;
                                border-top:1px solid #ddd;">
                        <div>
                            <span class="title-7 w-700">
                                Status:
                            </span>
                            <span class="title-7">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        @if($order->status !== 'cancelled')
                        <form
                            action="{{ route('orders.cancel', $order->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this order?');">
                            @csrf
                            <button
                                type="submit"
                                class="btn-1"
                                style="
                                            padding:8px 16px;
                                            font-size:13px;
                                            cursor:pointer;">
                                Cancel Order
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @empty
                <div
                    class="wrapper bg-grey br text-center flex flex-column gap-20"
                    style="
                            margin-top:20px;
                            padding:30px;">
                    <div class="title-4">
                        No orders yet
                    </div>
                    <p class="text-grey title-6">
                        You haven't purchased any products yet.
                    </p>
                    <div class="text-center w-100">
                        <a
                            href="{{ route('products') }}"
                            class="btn-1">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</main>

@endsection