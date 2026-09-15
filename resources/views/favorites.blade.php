@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        Favorites
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="favorites">
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
                            <button type="submit" class="title-6 menu-button {{ request()->routeIs('/') ? 'active' : '' }}">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            <div class="wrapper w-80 justify-content-center">
                <div class="flex justify-content-between align-items-center">
                    <div class="title-3 w-700">Favorites</div>
                    <div id="favorites-count" class="title-6 text-grey">0 products</div>
                </div>
                <div id="favorites-products" class="products-grid"></div>
                <div id="empty-favorites" class="empty-favorites">
                    <div class="title-4"> Your favorites are empty </div>
                    <p class="text-grey title-6">
                        Add products to your favorites
                        and they will appear here.
                    </p>
                    <a href="{{ route('products') }}" class="btn-2">Continue Shopping</a>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favoritesKey = 'favorites_user_{{ auth()->id() }}';
        let favorites = JSON.parse(localStorage.getItem(favoritesKey)) || [];
        const container = document.getElementById('favorites-products');
        const emptyMessage = document.getElementById('empty-favorites');
        const count = document.getElementById('favorites-count');

        count.textContent = favorites.length + (favorites.length === 1 ? ' product' : ' products');
        if (favorites.length === 0) {
            emptyMessage.style.display = 'block';
            return;
        }
        emptyMessage.style.display = 'none';
        favorites.forEach(function(product) {
            product.quantity = product.quantity || 1;
            const card = document.createElement('div');
            card.className = 'favorite-card';
            card.innerHTML = `
            <div class="product-image">
                <img src="${product.image}" alt="${product.title}">
            </div>
            <div class="product-info">
                <div>
                    <h2 class="title-7 w-700">
                        ${product.title}
                    </h2>
                    <p class="text-grey title-8">
                        Favorite product
                    </p>
                </div>
                <div class="products-info">
                    <div class="price text-red title-6 w-700">
                        $${product.price}
                    </div>
                    <button type="button" class="remove-favorite" data-id="${product.id}">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>
            </div>`;
            container.appendChild(card);
        });
        document.querySelectorAll('.favorite-plus').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let favorites = JSON.parse(
                    localStorage.getItem('favorites')
                ) || [];
                const product = favorites.find(function(item) {
                    return item.id == id;
                });
                if (product) {
                    product.quantity = (product.quantity || 1) + 1;
                    localStorage.setItem(
                        favoritesKey,
                        JSON.stringify(favorites)
                    );
                    location.reload();
                }
            });
        });
        document.querySelectorAll('.favorite-minus').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let favorites = JSON.parse(
                    localStorage.getItem('favorites')
                ) || [];
                const product = favorites.find(function(item) {
                    return item.id == id;
                });
                if (product) {
                    if (product.quantity > 1) {
                        product.quantity--;
                    }
                    localStorage.setItem(
                        'favorites',
                        JSON.stringify(favorites)
                    );
                    location.reload();
                }
            });
        });
        document.querySelectorAll('.add-to-cart').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                const id = this.dataset.id;
                let favorites = JSON.parse(
                    localStorage.getItem('favorites')
                ) || [];
                const product = favorites.find(function(item) {
                    return item.id == id;
                });
                if (!product) {
                    return;
                }
                let cart = JSON.parse(
                    localStorage.getItem('cart')
                ) || [];
                const existingProduct = cart.find(function(item) {
                    return item.id == id;
                });
                if (existingProduct) {
                    existingProduct.quantity = (existingProduct.quantity || 1) + (product.quantity || 1);
                } else {
                    cart.push({
                        id: product.id,
                        title: product.title,
                        price: product.price,
                        image: product.image,
                        quantity: product.quantity || 1
                    });
                }
                localStorage.setItem(
                    'cart',
                    JSON.stringify(cart)
                );
                updateCartCount();
            });
        });
        document.querySelectorAll('.remove-favorite').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let favorites = JSON.parse(
                    localStorage.getItem('favorites')
                ) || [];
                favorites = favorites.filter(function(product) {
                    return product.id != id;
                });
                localStorage.setItem(
                    'favorites',
                    JSON.stringify(favorites)
                );
                location.reload();
            });
        });
        updateCartCount();
    });

    function updateCartCount() {
        let cart = JSON.parse(
            localStorage.getItem('cart')
        ) || [];

        let totalQuantity = cart.reduce(
            function(total, product) {
                return total + (product.quantity || 1);
            },
            0
        );
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = totalQuantity;
        }
    }
</script>

@endsection