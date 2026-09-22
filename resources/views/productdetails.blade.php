@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="product-details">
                        <div class="product-details-image flex gap-10">
                            <div class="product-thumbnails flex flex-column">
                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}"
                                    class="thumbnail active"
                                    onclick="changeImage(this.src)">
                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}"
                                    class="thumbnail"
                                    onclick="changeImage(this.src)">
                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}"
                                    class="thumbnail"
                                    onclick="changeImage(this.src)">
                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}"
                                    class="thumbnail"
                                    onclick="changeImage(this.src)">
                            </div>
                            <div>
                                <img
                                    id="main-product-image"
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}">
                            </div>
                        </div>
                        <div class="product-details-info w-80">
                            <div class="flex flex-column gap-20">
                                <h1 class="title-2 w-700">
                                    {{ $product->title }}
                                </h1>
                                <p class="text-grey title-6">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="flex align-items-center gap-20"
                                style="padding-top:20px;">
                                <div class="title-5">
                                    Size
                                </div>
                                <div class="sizes flex gap-20">
                                    <button
                                        type="button"
                                        class="size-option"
                                        data-size="XS">
                                        XS
                                    </button>
                                    <button
                                        type="button"
                                        class="size-option"
                                        data-size="S">
                                        S
                                    </button>
                                    <button
                                        type="button"
                                        class="size-option"
                                        data-size="M">
                                        M
                                    </button>
                                    <button
                                        type="button"
                                        class="size-option"
                                        data-size="L">
                                        L
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex colors gap-10 align-items-center"
                                style="padding-top:20px;">
                                <div class="title-5 font-2">
                                    Color
                                </div>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Red"
                                    style="background-color:#FF2E00;"></button>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Pink"
                                    style="background-color:#F7DDD0;"></button>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Blue"
                                    style="background-color:#66A5FF;"></button>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Orange"
                                    style="background-color:#FF9D41;"></button>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Yellow"
                                    style="background-color:#FFD36C;"></button>
                                <button
                                    type="button"
                                    class="color color-option"
                                    data-color="Green"
                                    style="background-color:#4BCB88;"></button>
                            </div>
                            <div
                                class="quantity-wrapper flex align-items-center gap-20"
                                style="padding-top:20px;">
                                <div class="title-5 font-2">
                                    Quantity
                                </div>
                                <div class="quantity flex align-items-center">
                                    <button
                                        type="button"
                                        class="quantity-btn"
                                        onclick="decreaseQuantity()">
                                        −
                                    </button>
                                    <input
                                        type="number"
                                        id="quantity"
                                        value="1"
                                        min="1"
                                        readonly>
                                    <button
                                        type="button"
                                        class="quantity-btn"
                                        onclick="increaseQuantity()">
                                        +
                                    </button>
                                </div>
                            </div>
                            <div
                                class="price text-red title-2 w-700"
                                style="padding:20px 0;">
                                ${{ $product->price }}
                            </div>
                            <div class="flex gap-20">
                                <button
                                    type="button"
                                    id="add-to-cart"
                                    class="btn-1">
                                    ADD TO CART
                                </button>
                                <button
                                    type="button"
                                    id="shop-now"
                                    class="btn-1">
                                    SHOP NOW
                                </button>
                                <button
                                    type="button"
                                    id="favorite-button"
                                    style="
                                    border:none;
                                    background:none;
                                    cursor:pointer;">
                                    <i class="fa-regular fa-heart"
                                        id="favorite-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="recommended-products">
        <div class="row w-100">
            <div class="col w-100 justify-content-between">
                <div class="wrapper">
                    <div class="flex justify-content-between align-items-center">
                        <a href="{{ route('products') }}" class="w-500 title-3">
                            You may also like
                        </a>
                        <a href="{{ route('products') }}" class="btn-1">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: space-around;">
            <div class="col">
                <div class="wrapper">
                    <div class="products-grid">
                        @foreach($recommendedProducts as $recommendedProduct)
                        <div class="product-card">
                            <a href="{{ route('productdetails', $recommendedProduct->id) }}">
                                <img
                                    src="{{ asset($recommendedProduct->image) }}"
                                    alt="{{ $recommendedProduct->title }}">
                                <div style="padding:15px;">
                                    <div class="title-5 w-700">
                                        {{ $recommendedProduct->title }}
                                    </div>
                                    <p class="text-grey title-6">
                                        {{ $recommendedProduct->description }}
                                    </p>
                                    <div class="title-5 w-700 text-red"
                                        style="padding-top:10px;">
                                        ${{ $recommendedProduct->price }}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div id="message-modal"
    class="message-modal">
    <div class="message-modal-content">
        <button
            type="button"
            id="close-modal"
            class="close-modal">
            &times;
        </button>
        <div
            id="modal-message"
            class="title-5 text-center"></div>
        <button
            type="button"
            id="modal-ok"
            class="btn-1">
            OK
        </button>
    </div>
</div>
<style>
    .message-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .message-modal-content {
        position: relative;
        width: 350px;
        padding: 35px;
        background: white;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .message-modal-content .btn-1 {
        margin-top: 20px;
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        border: none;
        background: none;
        font-size: 25px;
        cursor: pointer;
    }
</style>
<script>
    function changeImage(image) {
        document.getElementById(
            'main-product-image'
        ).src = image;

    }

    function increaseQuantity() {
        let quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
    }


    function decreaseQuantity() {
        let quantity = document.getElementById('quantity');
        if (parseInt(quantity.value) > 1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }

    function showModal(message) {
        const modal = document.getElementById('message-modal');
        const modalMessage = document.getElementById('modal-message');
        modalMessage.textContent = message;
        modal.style.display = 'flex';
    }


    function closeModal() {
        document.getElementById('message-modal').style.display = 'none';
    }
    document.getElementById('close-modal').addEventListener(
        'click',
        closeModal
    );
    document.getElementById('modal-ok').addEventListener(
        'click',
        closeModal
    );
    let selectedSize = null;

    document.querySelectorAll('.size-option').forEach(function(button) {
        button.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(function(item) {
                item.classList.remove(
                    'selected'
                );
            });
            this.classList.add('selected');
            selectedSize = this.dataset.size;
        });
    });
    let selectedColor = null;

    document.querySelectorAll('.color-option').forEach(function(button) {
        button.addEventListener('click', function() {
            document.querySelectorAll('.color-option').forEach(function(item) {
                item.classList.remove(
                    'selected'
                );
            });
            this.classList.add('selected');
            selectedColor = this.dataset.color;
        });
    });
    const userId = "{{ auth()->id() }}";
    document.getElementById('add-to-cart').addEventListener('click', function() {
        if (!userId) {
            window.location.href = "{{ route('login') }}";
            return;
        }

        if (!selectedColor) {
            showModal(
                'Please select a color.'
            );
            return;
        }

        if (!selectedSize) {
            showModal(
                'Please select a size.'
            );
            return;
        }

        const quantity = Number(
            document.getElementById('quantity').value
        ) || 1;

        const product = {
            id: "{{ $product->id }}",
            title: "{{ $product->title }}",
            price: Number(
                "{{ $product->price }}"
            ),
            image: "{{ asset($product->image) }}",
            quantity: quantity,
            color: selectedColor,
            size: selectedSize
        };

        const cartKey = 'cart_user_' + userId;

        let cart = JSON.parse(
            localStorage.getItem(cartKey)
        ) || [];

        const existingProduct =
            cart.find(function(item) {
                return (
                    item.id == product.id &&
                    item.color == product.color &&
                    item.size == product.size
                );
            });

        if (existingProduct) {
            existingProduct.quantity =
                (Number(existingProduct.quantity) || 1) +
                product.quantity;
        } else {
            cart.push(product);
        }

        localStorage.setItem(
            cartKey,
            JSON.stringify(cart)
        );

        updateCartCount();
        showModal(
            'Product added to cart!'
        );
    });
    document.getElementById('shop-now').addEventListener('click', function() {
        window.location.href = "{{ route('products') }}";
    });
    const favoritesKey = 'favorites_user_' + userId;
    const favoriteButton = document.getElementById('favorite-button');

    const favoriteHeart =document.getElementById(
            'favorite-heart'
        );
    let favorites = JSON.parse(localStorage.getItem(favoritesKey)) || [];

    const productId = "{{ $product->id }}";

    function isFavorite() {
        return favorites.some(
            function(product) {
                return product.id == productId;
            }
        );
    }

    function updateFavoriteHeart() {
        if (isFavorite()) {
            favoriteHeart.classList.remove(
                'fa-regular'
            );
            favoriteHeart.classList.add(
                'fa-solid'
            );
            favoriteHeart.style.color =
                'red';
        } else {
            favoriteHeart.classList.remove(
                'fa-solid'
            );

            favoriteHeart.classList.add(
                'fa-regular'
            );

            favoriteHeart.style.color ='';
        }
    }
    updateFavoriteHeart();
    favoriteButton.addEventListener('click', function() {
        favorites = JSON.parse(
            localStorage.getItem(
                favoritesKey
            )
        ) || [];
        const index = favorites.findIndex(
            function(product) {
                return product.id == productId;
            }
        );
        if (index !== -1) {
            favorites.splice(index,1);
        } else {
            favorites.push({
                id: "{{ $product->id }}",
                title: "{{ $product->title }}",
                price: Number(
                    "{{ $product->price }}"
                ),
                image: "{{ asset($product->image) }}"
            });
        }
        localStorage.setItem(
            favoritesKey,
            JSON.stringify(favorites)
        );
        updateFavoriteHeart();
    });
</script>

@endsection