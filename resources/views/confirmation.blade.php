@extends('layouts.app')

@section('content')

<main>
    <section class="bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col w-30">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <div class="title-5 w-700">Categories</div>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <i class="fa-regular fa-user"></i>
                    <div class="title-6">Sign in</div>
                    <i class="fa-regular fa-heart"></i>
                    <a href="{{ route('favorites') }}">
                        <div class="title-6">Favorites</div>
                    </a>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <a href="{{ route('card') }}"
                        class="title-6 w-700 text-grey">
                        CARD(0)
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Card</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="wrapper flex gap-20 align-items-center">
                    <div class="title-6 w-700 text-grey">
                        CARD(0)
                    </div>
                    <div class="text-grey w-700">
                        SHIPPING & PAYMENT
                    </div>
                    <div class="title-6 w-700">
                        PRODUCT CONFIRMATION
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-grey br w-80" style="margin: 50px auto;">
        <div class="row justify-content-center flex flex-column gap-20">
            <div class="col">
                <div class="wrapper">
                    <div class="title-5 w-700">
                        Order Summary
                    </div>
                    <div id="order-products">
                        @foreach($order->items as $item)
                        <div class="flex justify-content-between"
                            style="margin-bottom: 15px;">
                            <div>
                                <div class="title-6 w-700">
                                    {{ $item->product->title }}
                                </div>
                                <div class="text-grey title-7">
                                    Quantity: {{ $item->quantity }}
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
                            <div class="title-6 w-700">
                                ${{ number_format(
                                    $item->price * $item->quantity,
                                    2
                                ) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="line"></div>
                    <div class="flex flex-column gap-20">
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6"> Price </div>
                            <div class="title-6">
                                ${{ number_format(
                                $order->total_price,
                                2
                            ) }}
                            </div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6"> Quantity</div>
                            <div class="title-6"> {{ $order->total_quantity }} </div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="title-6 w-700"> Total Price </div>
                            <div class="title-6 w-700 text-red">
                                ${{ number_format(
                                $order->total_price,
                                2
                            ) }}
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn-1 text-center">
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="flex gap-20 justify-content-center w-100">
                    <input type="text" placeholder="210548">
                    <button type="button" class="btn-1">
                        Apply code
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        localStorage.removeItem(cartKey);
    });
</script>

@endsection