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
                        <a href="{{ route('orders') }}"
                            class="title-6 menu-button {{ request()->routeIs('orders') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Orders
                        </a>
                        <a href="{{ route('carts') }}"
                            class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            My Cards
                        </a>
                        <a href="{{ route('favorites') }}"
                            class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </a>
                        <a href="{{ route('settings') }}"
                            class="title-6 menu-button {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                        <form action="{{ route('logout') }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                class="title-6 menu-button">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="cart-table"
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
                                        style="width:30%;">
                                        Product
                                    </th>
                                    <th
                                        class="title-6"
                                        style="
                                    width:130px;
                                    min-width:130px;
                                    text-align:center;">
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
                                        style="width:13%;">
                                        Price
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:15%;">
                                        Edit
                                    </th>
                                    <th
                                        class="title-6"
                                        style="width:10%;">
                                        Remove
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
                    <div class="flex flex-column gap-20 w-50 text-center">
                        <div class="title-4">
                            Your cart is empty
                        </div>
                        <p class="text-grey title-6">
                            Add some products to your cart.
                        </p>
                        <a href="{{ route('products') }}"
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
                    <a href="{{ route('payment') }}"
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
        let cart = JSON.parse(
            localStorage.getItem(cartKey)
        ) || [];
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
                        gap:20px;">
                        <img
                            src="${product.image}"
                            alt="${product.title}"
                            style="
                            width:70px;
                            height:100px;
                            object-fit:cover;
                            flex-shrink:0;">
                        <div>
                            <div
                                class="title-6 w-700">
                                ${product.title}
                            </div>
                        </div>
                    </div>
                </td>
                <td
                    style="
                    padding:20px 10px;
                    text-align:center;
                    vertical-align:middle;">
                    <div
                        style="
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        gap:8px;">
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
                            style="
                            width:35px;
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
                        onclick="editCartItem(${index})"
                        style="
                        border:none;
                        background:none;
                        cursor:pointer;
                        font-size:14px;
                        text-decoration:underline;">
                        Edit
                    </button>
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
                </td>
            `;
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

        window.editCartItem = function(index) {
            const product = cart[index];
            const modal = document.createElement('div');
            modal.id = 'cart-edit-modal';
            modal.style.cssText = `
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:9999;
        `;
            modal.innerHTML = `
            <div
                style="
                width:400px;
                max-width:90%;
                background:#fff;
                padding:30px;
                border-radius:4px;">
                <div
                    class="title-4 w-700"
                    style="margin-bottom:25px;">
                    Edit Product
                </div>
                <div
                    class="title-6 w-700"
                    style="margin-bottom:8px;">
                    Product
                </div>
                <div
                    class="title-6"
                    style="
                    padding:12px;
                    background:#f5f5f5;
                    margin-bottom:20px;">
                    ${product.title}
                </div>
                <div
                    class="title-6 w-700"
                    style="margin-bottom:8px;">
                    Quantity
                </div>
                <input
                    type="number"
                    id="edit-quantity"
                    value="${Number(product.quantity) || 1}"
                    min="1"
                    style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    margin-bottom:20px;
                    box-sizing:border-box;">
                <div
                    class="title-6 w-700"
                    style="margin-bottom:8px;">
                    Color
                </div>
                <select
                    id="edit-color"
                    style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    margin-bottom:20px;
                    box-sizing:border-box;">
                    <option value="">
                        Select Color
                    </option>
                    <option value="Red"
                        ${product.color === 'Red' ? 'selected' : ''}>
                        Red
                    </option>
                    <option value="Blue"
                        ${product.color === 'Blue' ? 'selected' : ''}>
                        Blue
                    </option>
                    <option value="Green"
                        ${product.color === 'Green' ? 'selected' : ''}>
                        Green
                    </option>
                    <option value="Pink"
                        ${product.color === 'Pink' ? 'selected' : ''}>
                        Pink
                    </option>
                    <option value="Black"
                        ${product.color === 'Black' ? 'selected' : ''}>
                        Black
                    </option>
                </select>
                <div
                    class="title-6 w-700"
                    style="margin-bottom:8px;">
                    Size
                </div>
                <select
                    id="edit-size"
                    style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    margin-bottom:25px;
                    box-sizing:border-box;">
                    <option value="">
                        Select Size
                    </option>
                    <option value="XS"
                        ${product.size === 'XS' ? 'selected' : ''}>
                        XS
                    </option>
                    <option value="S"
                        ${product.size === 'S' ? 'selected' : ''}>
                        S
                    </option>
                    <option value="M"
                        ${product.size === 'M' ? 'selected' : ''}>
                        M
                    </option>
                    <option value="L"
                        ${product.size === 'L' ? 'selected' : ''}>
                        L
                    </option>
                </select>
                <div
                    style="
                    display:flex;
                    justify-content:flex-end;
                    gap:10px;">
                    <button
                        type="button"
                        id="cancel-edit"
                        style="
                        padding:12px 20px;
                        border:1px solid #ddd;
                        background:#fff;
                        cursor:pointer;">
                        Cancel
                    </button>
                    <button
                        type="button"
                        id="save-edit"
                        class="btn-1">
                        Save
                    </button>
                </div>
            </div>
        `;

            document.body.appendChild(modal);
            document.getElementById('cancel-edit').addEventListener('click', function() {
                modal.remove();
            });

            document.getElementById('save-edit').addEventListener('click', function() {
                const quantity = Number(document.getElementById('edit-quantity').value);
                const color = document.getElementById('edit-color').value;
                const size = document.getElementById('edit-size').value;
                if (!quantity || quantity < 1) {
                    alert('Quantity must be at least 1.');
                    return;
                }
                cart[index].quantity = quantity;
                cart[index].color = color || 'Default';
                cart[index].size = size || 'Default';
                saveCart();
                modal.remove();
            });

            modal.addEventListener('click', function(event) {

                if (event.target === modal) {
                    modal.remove();
                }
            });
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

            const cardHeaderCount = document.getElementById('card-header-count');
            if (cardHeaderCount) {

                cardHeaderCount.textContent = 'CARD(' + totalQuantity + ')';
            }
        }
        renderCart();
        updateHeaderCartCount();
    });
</script>

@endsection