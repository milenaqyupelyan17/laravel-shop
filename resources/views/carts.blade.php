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
                    id="cart-table-wrapper"
                    class="wrapper bg-grey br"
                    style="display:none;">
                    <div style="overflow-x:auto;"
                        <table
                            style="
                                width:100%;
                                border-collapse:collapse;
                            ">
                            <thead>
                                <tr>
                                    <th
                                        class="title-6 text-left"
                                        style="
                                            padding:18px;
                                            width:70%;">
                                        Product
                                    </th>
                                    <th
                                        class="title-6"
                                        style="
                                            padding:18px;
                                            width:30%;
                                            text-align:center;
                                        ">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body"></tbody>
                        </table>
                    </div>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart =
            JSON.parse(
                localStorage.getItem(cartKey)
            ) || [];

        const cartBody = document.getElementById(
                'cart-table-body'
            );

        const cartTableWrapper = document.getElementById(
                'cart-table-wrapper'
            );

        const emptyCart = document.getElementById(
                'empty-cart'
            );

        const cartTotal = document.getElementById(
                'cart-total'
            );

        const cartTotalWrapper = document.getElementById(
                'cart-total-wrapper'
            );

        const paymentWrapper = document.getElementById(
                'payment-wrapper');

        const cardHeaderCount = document.getElementById(
                'card-header-count'
            );

        function renderCart() {
            cartBody.innerHTML = '';
            let total = 0;
            if (cart.length === 0) {

                cartTableWrapper.style.display ='none';
                emptyCart.style.display ='flex';
                cartTotalWrapper.style.display ='none';
                paymentWrapper.style.display = 'none';
                cardHeaderCount.textContent = 'CARD(0)';
                return;
            }

            cartTableWrapper.style.display ='block';
            emptyCart.style.display ='none';
            cartTotalWrapper.style.display ='flex';
            paymentWrapper.style.display =
                'flex';
            cart.forEach(function(
                product,
                index
            ) {

                const quantity = Number(product.quantity) || 1;
                const price = Number(product.price) || 0;
                const productTotal = price * quantity;
                total += productTotal;
                const row = document.createElement('tr');
                row.innerHTML = `
                <td
                    style="
                        padding:20px 18px;
                        vertical-align:middle;
                        border-top:1px solid #e5e5e5;">
                    <div
                        style="
                            display:flex;
                            align-items:center;
                            gap:15px;">
                        <img
                            src="${product.image}"
                            alt="${product.title}"
                            style="
                                width:60px;
                                height:80px;
                                object-fit:contain;
                                flex-shrink:0;">
                        <span
                            class="title-6 w-700">
                            ${product.title}
                        </span>
                    </div>
                </td>
                <td
                    style="
                        padding:20px 18px;
                        text-align:center;
                        vertical-align:middle;
                        border-top:1px solid #e5e5e5;">
                    <div
                        style="
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            gap:10px;">
                        <button
                            type="button"
                            onclick="decreaseCartQuantity(${index})"
                            style="
                                width:30px;
                                height:30px;
                                border:1px solid #ddd;
                                background:#fff;
                                cursor:pointer;
                                font-size:16px;">
                            −
                        </button>
                        <span
                            class="title-6"
                            style="
                                min-width:30px;
                                text-align:center;">
                            ${quantity}
                        </span>
                        <button
                            type="button"
                            onclick="increaseCartQuantity(${index})"
                            style="
                                width:30px;
                                height:30px;
                                border:1px solid #ddd;
                                background:#fff;
                                cursor:pointer;
                                font-size:16px;">
                            +
                        </button>
                    </div>
                </td>
            `;
                cartBody.appendChild(row);
            });

            cartTotal.textContent ='$' + total.toFixed(2);
            let totalQuantity = 0;

            cart.forEach(function(product) {
                totalQuantity +=Number(product.quantity) || 0;
            });

            cardHeaderCount.textContent = 'CARD(' + totalQuantity + ')';

        }

        window.increaseCartQuantity = function(index) {
                cart[index].quantity =
                    (
                        Number(
                            cart[index].quantity
                        ) || 1
                    ) + 1;
                saveCart();
            };

        window.decreaseCartQuantity = function(index) {

                const quantity =Number(
                        cart[index].quantity
                    ) || 1;
                if (quantity > 1) {
                    cart[index].quantity =
                        quantity - 1;

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