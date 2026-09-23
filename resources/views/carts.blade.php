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
    <div class="row align-items-start flex gap-20">
        <section id="account"
            class="w-20"
            style="min-height:50vh;">
            <div class="wrapper bg-grey"
                style="min-height:50vh;">
                <div class="flex flex-column gap-20"
                    style="padding:30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <div class="flex flex-column gap-20">
                        <a href="{{ route('dashboard') }}"
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
                        <a href="{{ route('favorites') }}"
                            class="title-6 menu-button{{ request()->routeIs('favorites') ? 'active' : '' }}">
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
                <div class="wrapper bg-grey br">
                    <div style="overflow-x:auto;">
                        <table
                            style="
                            width:100%;
                            border-collapse:collapse;
                            table-layout:fixed;">
                            <thead>
                                <tr>
                                    <th
                                        class="title-6 text-left"
                                        style="width:35%;">
                                        Product
                                    </th>
                                    <th
                                        class="title-6"
                                        style="
                                        width:140px;
                                        min-width:140px;
                                        text-align:center;
                                    ">
                                        Quantity
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:12%;">
                                        Color
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:12%;">
                                        Size
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:15%;">
                                        Price
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:10%;">
                                        Remove
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                            </tbody>
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
                <div class="flex justify-content-end">
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
                <div class="w-100 justify-content-end flex">
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
        let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
        const cartBody = document.getElementById('cart-table-body');
        const emptyCart = document.getElementById('empty-cart');
        const cartTotal = document.getElementById('cart-total');
        const paymentButton = document.getElementById('payment-button');

        function renderCart() {
            cartBody.innerHTML = '';
            let total = 0;
            if (cart.length === 0) {
                emptyCart.style.display = 'flex';
                cartTotal.textContent = '$0.00';
                if (paymentButton) {
                    paymentButton.style.display = 'none';
                }
                return;
            }

            emptyCart.style.display = 'none';
            if (paymentButton) {
                paymentButton.style.display = 'inline-block';
            }
            cart.forEach(function(product, index) {
                const quantity = Number(product.quantity) || 1;
                const price = Number(product.price) || 0;
                const productTotal = price * quantity;
                total += productTotal;
                const row = document.createElement('tr');
                row.innerHTML = `
                <td
                    style="
                        padding:20px 10px;
                        vertical-align:middle;">
                    <div
                        style="
                            display:flex;
                            align-items:center;
                            gap:20px;
                        ">
                        <img
                            src="${product.image}"
                            alt="${product.title}"
                            style="
                                width:70px;
                                height:100px;
                                object-fit:cover;
                                flex-shrink:0;">
                        <div>
                            <div class="title-6 w-700">
                                ${product.title}
                            </div>
                        </div>
                    </div>
                </td>
                <td
                    style="
                        padding:20px 10px;
                        width:140px;
                        min-width:140px;
                        text-align:center;
                        vertical-align:middle;">
                    <div
                        style="
                            width:100%;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            gap:8px;
                            white-space:nowrap;">
                        <button
                            type="button"
                            onclick="decreaseCartQuantity(${index})"
                            style="
                                width:30px;
                                min-width:30px;
                                height:30px;
                                padding:0;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                border:1px solid #ddd;
                                background:#fff;
                                cursor:pointer;
                                font-size:16px;">
                            −
                        </button>
                        <span
                            style="
                                width:35px;
                                min-width:35px;
                                display:inline-block;
                                text-align:center;
                                font-size:14px;">
                            ${quantity}
                        </span>
                        <button
                            type="button"
                            onclick="increaseCartQuantity(${index})"
                            style="
                                width:30px;
                                min-width:30px;
                                height:30px;
                                padding:0;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                border:1px solid #ddd;
                                background:#fff;
                                cursor:pointer;
                                font-size:16px;">
                            +
                        </button>
                    </div>
                </td>
                <td
                    style="
                        padding:20px 10px;
                        text-align:center;
                        vertical-align:middle;">
                    <span class="title-6">
                        ${product.color || 'Default'}
                    </span>
                </td>
                <td
                    style="
                        padding:20px 10px;
                        text-align:center;
                        vertical-align:middle;">
                    <span class="title-6">
                        ${product.size || 'Default'}
                    </span>
                </td>
                <td
                    style="
                        padding:20px 10px;
                        text-align:center;
                        vertical-align:middle;">
                    <span class="title-6 w-700">
                        $${productTotal.toFixed(2)}
                    </span>
                </td>
                <td
                    style="
                        padding:20px 10px;
                        text-align:center;
                        vertical-align:middle;">
                    <button
                        type="button"
                        onclick="removeFromCart(${index})"
                        style="
                            border:none;
                            background:none;
                            cursor:pointer;
                            font-size:18px;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>`;
                cartBody.appendChild(row);
            });
            cartTotal.textContent = '$' + total.toFixed(2);
        }

        window.increaseCartQuantity = function(index) {
            cart[index].quantity = (Number(cart[index].quantity) || 1) + 1;
            saveCart();
        };

        window.decreaseCartQuantity = function(index) {
            const currentQuantity = Number(cart[index].quantity) || 1;
            if (currentQuantity > 1) {
                cart[index].quantity = currentQuantity - 1;
                saveCart();
            }
        };

        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            saveCart();
        };

        function saveCart() {
            localStorage.setItem(
                cartKey,
                JSON.stringify(cart)
            );
            renderCart();
            updateHeaderCartCount();
        }

        function updateHeaderCartCount() {
            let totalQuantity = 0;
            cart.forEach(function(product) {
                totalQuantity += Number(product.quantity) || 0;
            });

            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = totalQuantity;
            }
        }
        renderCart();
        updateHeaderCartCount();

    });
</script>

@endsection