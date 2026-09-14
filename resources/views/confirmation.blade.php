@extends('layouts.app')

@section('content')
<main>
    <section class="bg-black w-100">
        <div class=" row justify-content-between align-items-center">
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
                    <a href="{{ route('card') }}" id="card-header-count" class="title-6 w-700 text-grey"> CARD(0) </a>
                </div>
            </div>
        </div>
    </section>
    <section id="">
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
                    <a href="{{ route('card') }}" id="card-header-count" class="title-6 w-700 text-grey">CARD(0)</a>
                    <a href="{{ route('payment') }}" class="text-grey w-700">SHIPPING & PAYMENT</a>
                    <a href="{{ route('confirmation') }}" class="title-6 w-700">PRODUCT CONFIRMATION</a>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-grey br w-50">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-5 w-700"> Order Summary </div>
                    <div id="order-products"></div>
                    <div class="line"></div>
                    <div class="flex justify-content-between">
                        <div class="text-grey title-6">Price</div>
                        <div id="order-price" class="title-6">$0</div>
                    </div>
                    <div class="flex justify-content-between">
                        <div class="text-grey title-6">Quantity</div>
                        <div id="order-quantity" class="title-6">0</div>
                    </div>
                    <div class="flex justify-content-between">
                        <div class="title-6 w-700">Total Price</div>
                        <div id="order-total"
                            class="title-6 w-700 text-red">$0</div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn-2">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="flex gap-10">
                        <input type="text" placeholder="210548">
                        <button type="button" class="btn-1">
                            Apply code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let orderProducts = document.getElementById('order-products');
        let orderPrice = document.getElementById('order-price');
        let orderQuantity = document.getElementById('order-quantity');
        let orderTotal = document.getElementById('order-total');
        let total = 0;
        let quantity = 0;

        cart.forEach(function(product) {
            let productQuantity = Number(product.quantity) || 1;
            let productPrice = Number(product.price) || 0;
            let productTotal = productPrice * productQuantity;
            total += productTotal;
            quantity += productQuantity;
            orderProducts.innerHTML += `
            <div class="flex justify-content-between"
                 style="margin-bottom:15px;">
                <div>
                    <div class="title-6 w-700">
                        ${product.title}
                    </div>
                    <div class="text-grey title-7">
                        Quantity: ${productQuantity}
                    </div>
                    <div class="text-grey title-7">
                        Color: ${product.color || 'Not selected'}
                    </div>
                    <div class="text-grey title-7">
                        Size: ${product.size || 'Not selected'}
                    </div>
                </div>
                <div class="title-6 w-700">
                    $${productTotal.toFixed(2)}
                </div>
            </div>
        `;
        });
        orderPrice.textContent = '$' + total.toFixed(2);
        orderQuantity.textContent = quantity;
        orderTotal.textContent = '$' + total.toFixed(2);
    });
</script>
@endsection