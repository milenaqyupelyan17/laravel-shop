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
        <section id="account" class="w-20" style="min-height:50vh;">
            <div class="wrapper bg-grey" style="min-height:50vh;">
                <div class="flex flex-column gap-20" style="padding:30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <div class="flex flex-column gap-20">
                        <a href="{{ route('dashboard') }}"
                           class="title-6 menu-button {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </a>
                        <a href="{{ route('settings') }}"
                           class="title-6 menu-button {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                        <a href="{{ route('carts') }}"
                           class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Cards
                        </a>
                        <a href="{{ route('favorites') }}"
                           class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="title-6 menu-button">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="cart-table" style="width:80%;">
            <div class="wrapper">
                <div class="title-3 w-700">
                    Shopping Cart
                </div>
                <div class="wrapper bg-grey br">
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th class="title-6 text-left">
                                        Product
                                    </th>
                                    <th class="title-6">
                                        Quantity
                                    </th>
                                    <th class="title-6">
                                        Color
                                    </th>
                                    <th class="title-6">
                                        Size
                                    </th>
                                    <th class="title-6">
                                        Price
                                    </th>
                                    <th class="title-6">
                                        Remove
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="empty-cart"
                    class="wrapper text-center flex flex-column gap-20 align-items-center"
                    style="display:none;">
                    <div class="flex flex-column gap-20 w-50 text-center">
                        <div class="title-4">
                            Your cart is empty
                        </div>
                        <p class="text-grey title-6">
                            Add some products to your cart.
                        </p>
                        <a href="{{ route('products') }}" class="btn-1">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                <div class="flex justify-content-end">
                    <div class="title-5 w-700" style="padding:20px;">
                        Total:
                        <span class="text-red" id="cart-total">
                            $0.00
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartKey = 'cart_user_{{ auth()->id() }}';
    let cart = JSON.parse(
        localStorage.getItem(cartKey)
    ) || [];
    const cartBody = document.getElementById('cart-table-body');
    const emptyCart = document.getElementById('empty-cart');
    const cartTotal = document.getElementById('cart-total');
    function renderCart() {
        cartBody.innerHTML = '';
        let total = 0;
        if (cart.length === 0) {
            emptyCart.style.display = 'flex';
            cartTotal.textContent = '$0.00';
            return;
        }
        emptyCart.style.display = 'none';
        cart.forEach(function (product, index) {
            const quantity = Number(product.quantity) || 1;
            const price = Number(product.price) || 0;
            const productTotal = price * quantity;
            total += productTotal;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td style="padding:20px 10px;">
                    <div class="flex align-items-center gap-20">
                        <img
                            src="${product.image}"
                            alt="${product.title}"
                            style="
                                width:70px;
                                height:100px;
                                object-fit:cover;
                            "
                        >
                        <div>
                            <div class="title-6 w-700">
                                ${product.title}
                            </div>
                        </div>
                    </div>
                </td>
                <td style="padding:20px 10px; text-align:center;">
                    <div class="flex align-items-center justify-content-center gap-10">
                        <button
                            type="button"
                            class="quantity-btn"
                            onclick="decreaseCartQuantity(${index})">
                            −
                        </button>
                        <span class="title-6">
                            ${quantity}
                        </span>
                        <button
                            type="button"
                            class="quantity-btn"
                            onclick="increaseCartQuantity(${index})">
                            +
                        </button>
                    </div>
                </td>
                <td style="padding:20px 10px; text-align:center;">
                    <span class="title-6">
                        ${product.color || 'Default'}
                    </span>
                </td>
                <td style="padding:20px 10px; text-align:center;">
                    <span class="title-6">
                        ${product.size || 'Default'}
                    </span>
                </td>
                <td style="padding:20px 10px; text-align:center;">
                    <span class="title-6 w-700">
                        $${productTotal.toFixed(2)}
                    </span>
                </td>
                <td style="padding:20px 10px; text-align:center;">
                    <button
                        type="button"
                        onclick="removeFromCart(${index})"
                        style="
                            border:none;
                            background:none;
                            cursor:pointer;
                            font-size:18px;
                        ">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            cartBody.appendChild(row);
        });
        cartTotal.textContent ='$' + total.toFixed(2);
    }

    window.increaseCartQuantity = function(index) {
        cart[index].quantity =(Number(cart[index].quantity) || 1) + 1;
        saveCart();
    };

    window.decreaseCartQuantity = function(index) {
        if (Number(cart[index].quantity) > 1) {
            cart[index].quantity--;
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
            cartCount.textContent =
                totalQuantity;
        }
    }
    renderCart();
    updateHeaderCartCount();
});
</script>

@endsection