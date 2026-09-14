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
    <div class="row align-items-start flex gap-40">
        <section id="account" class="w-20" style="min-height: 100vh;">
            <div class="wrapper bg-grey" style="min-height: 100vh;">
                <div class="flex flex-column gap-40" style="padding: 30px;">
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
        <section id="cart-table">
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
                            <tbody id="cart-table-body"></tbody>
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
                    <div class="wrapper br">
                        <div class="title-5 w-700" style=" padding: 20px;">Total:
                            <span id="cart-total" class="text-red">$0</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey =
            'cart_user_{{ auth()->id() }}';
        let cart = JSON.parse(
            localStorage.getItem(cartKey)
        ) || [];
        const tableBody = document.getElementById('cart-table-body');
        const emptyCart = document.getElementById('empty-cart');
        const totalElement = document.getElementById('cart-total');
        const cartCount = document.getElementById('cart-count');
        let total = 0;
        let totalQuantity = 0;

        if (cart.length === 0) {
            emptyCart.style.display = 'block';
            totalElement.textContent = '$0';
            if (cartCount) {
                cartCount.textContent = '0';
            }
            return;
        }

        cart.forEach(function(product) {
            product.quantity = Number(product.quantity) || 1;
            product.price = Number(product.price) || 0;
            const productTotal = product.price * product.quantity;
            total += productTotal;
            totalQuantity += product.quantity;
            const row = document.createElement('tr');
            row.innerHTML = `
            <td style="padding:20px 10px;">
                <div class="flex align-items-center gap-10">
                    <img src="${product.image}" alt="${product.title}"
                        style="
                            width:70px;
                            height:90px;
                            object-fit:cover;">
                    <div>
                        <div class="title-6 w-700">
                            ${product.title}
                        </div>
                        <div class="text-grey title-7">
                            $${product.price.toFixed(2)}
                        </div>
                    </div>
                </div>
            </td>
            <td style="padding:20px 10px;">
                <div class="quantity flex align-items-center">
                    <button type="button" class="quantity-minus" data-id="${product.id}" data-color="${product.color}" data-size="${product.size}">
                        −
                    </button>
                    <span class="quantity-number" style="padding:0 15px;">
                        ${product.quantity}
                    </span>
                    <button type="button" class="quantity-plus" data-id="${product.id}" data-color="${product.color}" data-size="${product.size}">
                        +
                    </button>
                </div>
            </td>
            <td style="padding:20px 10px;">
                <div class="flex align-items-center gap-5">
                    <span style="
                            width:20px;
                            height:20px;
                            border-radius:50%;
                            background:${getColor(product.color)};
                            display:inline-block; ">
                    </span>
                    <span>
                        ${product.color || 'Default'}
                    </span>
                </div>
            </td>
            <td style="padding:20px 10px;">
                <span class="title-6">
                    ${product.size || 'M'}
                </span>
            </td>
            <td style="padding:20px 10px;">
                <span class="title-6 w-700">
                    $${productTotal.toFixed(2)}
                </span>
            </td>
            <td style="padding:20px 10px;">
                <span class="title-6">
                    ${product.quantity}
                </span>
            </td>
            <td style="padding:20px 10px;">
                <button
                    type="button"
                    class="remove-product"
                    data-id="${product.id}"
                    data-color="${product.color}"
                    data-size="${product.size}"
                    style="
                        border:none;
                        background:none;
                        cursor:pointer;">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;
            tableBody.appendChild(row);
        });
        totalElement.textContent =
            '$' + total.toFixed(2);
        if (cartCount) {
            cartCount.textContent =
                totalQuantity;
        }
        document.querySelectorAll('.quantity-plus').forEach(function(button) {
            button.addEventListener(
                'click',
                function() {
                    const id = this.dataset.id;
                    const color = this.dataset.color;
                    const size = this.dataset.size;
                    let cart = JSON.parse(
                        localStorage.getItem(cartKey)
                    ) || [];
                    const product = cart.find(function(item) {
                        return item.id == id &&
                            item.color == color &&
                            item.size == size;
                    });


                    if (product) {
                        product.quantity = Number(product.quantity) + 1;
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        location.reload();
                    }
                }
            );
        });
        document.querySelectorAll('.quantity-minus').forEach(function(button) {
            button.addEventListener(
                'click',
                function() {
                    const id = this.dataset.id;
                    const color = this.dataset.color;
                    const size = this.dataset.size;
                    let cart = JSON.parse(
                        localStorage.getItem(cartKey)
                    ) || [];
                    const index =
                        cart.findIndex(function(item) {
                            return item.id == id &&
                                item.color == color &&
                                item.size == size;
                        });
                    if (index !== -1) {
                        if (
                            Number(cart[index].quantity) > 1
                        ) {
                            cart[index].quantity--;
                        }
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        location.reload();
                    }
                }
            );
        });
        document.querySelectorAll('.remove-product').forEach(function(button) {
            button.addEventListener(
                'click',
                function() {
                    const id = this.dataset.id;
                    const color = this.dataset.color;
                    const size = this.dataset.size;
                    let cart = JSON.parse(
                        localStorage.getItem(cartKey)
                    ) || [];
                    cart = cart.filter(function(product) {
                        return !(
                            product.id == id &&
                            product.color == color &&
                            product.size == size
                        );
                    });
                    localStorage.setItem(
                        cartKey,
                        JSON.stringify(cart)
                    );
                    location.reload();
                }
            );
        });

        function getColor(color) {
            if (!color) {
                return '#cccccc';
            }
            const colors = {
                Red: '#FF2E00',
                Pink: '#F7DDD0',
                Blue: '#66A5FF',
                Orange: '#FF9D41',
                Yellow: '#FFD36C',
                Green: '#4BCB88',
                Black: '#000000',
                White: '#ffffff'
            }
            return colors[color] || '#cccccc';
        }
    });
</script>

@endsection