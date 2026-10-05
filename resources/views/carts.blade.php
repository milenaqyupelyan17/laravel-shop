@extends('layouts.app')

@section('content')

<main>
    <div class="row">
        <div class="col">
            <div class="wrapper">
                <div class="title-6 flex gap-5 align-items-center">
                    <a href="{{ route('home') }}">
                        Homepage
                    </a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span>Cart</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="wrapper flex gap-20 align-items-center">
                <a
                    href="{{ route('carts') }}"
                    id="card-header-count"
                    class="title-6 w-700"
                    style="letter-spacing:1px;">
                    CARD (0)
                </a>
                <div class="title-6 w-700 text-grey">
                    SHIPPING & PAYMENT
                </div>
                <div class="title-6 text-grey w-700">
                    PRODUCT CONFIRMATION
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-start flex gap-20">
        <section
            id="account"
            class="w-20"
            style="min-height:50vh;">
            <div
                class="wrapper bg-grey"
                style="min-height:50vh;">
                <div
                    class="flex flex-column gap-20"
                    style="padding:30px;">
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
            id="cart-table"
            style="width:80%;">
            <div class="wrapper">
                <div class="title-3 w-700">
                    Shopping Cart
                </div>
                <div
                    id="cart-products-wrapper"
                    class="cart-products-grid"
                    style="display:none;">
                </div>
                <div
                    id="empty-cart"
                    class="wrapper text-center flex flex-column gap-20 align-items-center"
                    style="display:none;">
                    <div
                        class="flex flex-column gap-20 w-50 text-center">
                        <div class="title-4">
                            Your cart is empty
                        </div>
                        <p class="text-grey title-6">
                            Add some products to your cart.
                        </p>
                        <a
                            href="{{ route('products') }}"
                            class="btn-1">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                <div
                    class="flex justify-content-end"
                    id="cart-total-wrapper"
                    style="display:none;">
                    <div
                        class="title-5 w-700"
                        style="padding:20px 0;">
                        Total:
                        <span
                            class="text-red"
                            id="cart-total">
                            $0.00
                        </span>
                    </div>
                </div>
                <div
                    class="w-100 justify-content-end flex"
                    id="payment-wrapper"
                    style="display:none;">
                    <a
                        href="{{ route('payment') }}"
                        class="btn-1"
                        id="payment-button">
                        Start Order
                    </a>
                </div>
            </div>
        </section>
    </div>
</main>
<style>
    .cart-products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 30px;
    }


    .cart-product-card {
        border: 1px solid grey;
        border-radius: 6px;
        overflow: hidden;
        padding: 20px;
        display: flex;
        flex-direction: column;
        transition: 0.3s ease;
    }


    .cart-product-card:hover {
        transform: translateY(-3px);
    }


    .cart-product-image {
        width: 100%;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        margin-bottom: 18px;
    }


    .cart-product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }


    .cart-product-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }


    .cart-product-price {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 15px;
    }


    .cart-product-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 15px;
    }


    .quantity-box {
        display: flex;
        align-items: center;
        gap: 8px;
    }


    .quantity-button {
        width: 32px;
        height: 32px;

        border: 1px solid #ddd;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }


    .quantity-number {
        min-width: 30px;
        text-align: center;
        font-weight: 700;
    }


    .cart-product-total {
        font-weight: 700;
        font-size: 16px;
    }


    @media (max-width: 1000px) {

        .cart-products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }


    @media (max-width: 600px) {

        .cart-products-grid {
            grid-template-columns: 1fr;
        }

    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
        const productsWrapper = document.getElementById('cart-products-wrapper');
        const emptyCart = document.getElementById('empty-cart');
        const cartTotal = document.getElementById('cart-total');
        const cartTotalWrapper = document.getElementById('cart-total-wrapper');
        const paymentWrapper = document.getElementById('payment-wrapper');
        const cardHeaderCount = document.getElementById('card-header-count');

        function renderCart() {
            productsWrapper.innerHTML = '';
            let total = 0;
            let totalQuantity = 0;
            if (cart.length === 0) {
                productsWrapper.style.display = 'none';
                emptyCart.style.display = 'flex';
                cartTotalWrapper.style.display = 'none';
                paymentWrapper.style.display = 'none';
                cardHeaderCount.textContent = 'CARD (0)';
                return;
            }

            productsWrapper.style.display = 'grid';
            emptyCart.style.display = 'none';
            cartTotalWrapper.style.display = 'flex';
            paymentWrapper.style.display = 'flex';
            cart.forEach(function(product, index) {
                const quantity = Number(product.quantity) || 1;
                const price = Number(product.price) || 0;
                const productTotal = price * quantity;
                total += productTotal;
                totalQuantity += quantity;
                const card = document.createElement('div');
                card.className = 'cart-product-card';
                card.innerHTML = `
                <div class="cart-product-image">
                    <img
                        src="${product.image}"
                        alt="${product.title}">
                </div>
                <div class="cart-product-title">
                    ${product.title}
                </div>
                <div class="cart-product-price">
                    $${price.toFixed(2)}
                </div>
                <div class="cart-product-info">
                    <div class="quantity-box">
                        <button
                            type="button"
                            class="quantity-button"
                            onclick="decreaseCartQuantity(${index})">
                            −
                        </button>
                        <span class="quantity-number">
                            ${quantity}
                        </span>
                        <button
                            type="button"
                            class="quantity-button"
                            onclick="increaseCartQuantity(${index})">
                            +
                        </button>
                    </div>
                    <div class="cart-product-total">
                        $${productTotal.toFixed(2)}
                    </div>
                </div>
            `;

                productsWrapper.appendChild(card);
            });
            cartTotal.textContent = '$' + total.toFixed(2);
            cardHeaderCount.textContent = 'CARD (' + totalQuantity + ')';
        }


        window.increaseCartQuantity = function(index) {
            cart[index].quantity =
                (Number(cart[index].quantity) || 1) + 1;
            saveCart();
        };


        window.decreaseCartQuantity = function(index) {
            const quantity = Number(cart[index].quantity) || 1;

            if (quantity > 1) {
                cart[index].quantity = quantity - 1;
                saveCart();
            }
        };


        function saveCart() {
            localStorage.setItem(
                cartKey,
                JSON.stringify(cart)
            );
            renderCart();
        }
        renderCart();
    });
</script>

@endsection