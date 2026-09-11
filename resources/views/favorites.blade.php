@extends('layouts.app')

@section('content')

<main>
    <section class="bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <a href="{{ route('categories') }}">
                        <div class="title-5 w-700">Categories</div>
                    </a>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <a href="{{ route('login') }}">
                            <div class="title-6">Sign in </div>
                        </a>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-heart"></i>
                        <a href="{{ route('favorites') }}">
                            <div class="title-6"> Favorites</div>
                        </a>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <a href="{{ route('card') }}">
                            <div class="title-6">Card </div>
                        </a>
                        <span id="cart-count" class="cart title-7">0</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="favorites">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
                    <div class="flex justify-content-between align-items-center">
                        <div class="title-3 w-700">Favorites</div>
                        <div id="favorites-count" class="title-6 text-grey">0 products</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
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
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
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
                    <div class="quantity flex align-items-center gap-5">
                        <button type="button" class="favorite-minus"  data-id="${product.id}">−</button>
                        <span class="favorite-quantity">
                            ${product.quantity}
                        </span>
                        <button type="button" class="favorite-plus" data-id="${product.id}">+</button>
                    </div>
                    <button type="button" class="add-to-cart" data-id="${product.id}">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Add to Cart
                    </button>
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
                        'favorites',
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
                return total +
                    (product.quantity || 1);
            },
            0
        );

        const cartCount =
            document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = totalQuantity;
        }
    }
</script>

@endsection