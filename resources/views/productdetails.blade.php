@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">Homepage</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        {{ $product->title }}
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
                        <div class="product-details-image">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="product-details-info">
                            <div class="flex flex-column gap-20">
                                <h1 class="title-2 w-700">
                                    {{ $product->title }}
                                </h1>
                                <p class="text-grey title-6">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="price text-red title-2 w-700">
                                ${{ $product->price }}
                            </div>
                            <div class="quantity-wrapper flex align-items-center gap-20">
                                <div class="title-5 font-2">Quantity</div>
                                <div class="quantity flex align-items-center">
                                    <button type="btn-1" class="quantity-btn" onclick="decreaseQuantity()">−</button>
                                    <input
                                        type="number"
                                        id="quantity"
                                        value="1"
                                        min="1"
                                        readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            <div class="flex gap-20">
                                <button type="button"
                                    id="add-to-cart"
                                    class="btn-1">
                                    Add to Cart
                                </button>
                                <button
                                    type="button"
                                    id="favorite-button"
                                    style="border:none; background:none; cursor:pointer;">
                                    <i class="fa-regular fa-heart" id="favorite-heart"></i>
                                </button>
                            </div>
                            <div class="flex colors gap-10 align-items-center" style="padding-top: 20px;">
                                <div class="title-5 font-2">Color</div>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Red"
                                    style="background-color: #FF2E00;">
                                </button>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Pink"
                                    style="background-color: #F7DDD0;">
                                </button>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Blue"
                                    style="background-color: #66A5FF;">
                                </button>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Orange"
                                    style="background-color: #FF9D41;">
                                </button>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Yellow"
                                    style="background-color: #FFD36C;">
                                </button>
                                <button type="button"
                                    class="color color-option"
                                    data-color="Green"
                                    style="background-color: #4BCB88;">
                                </button>
                            </div>
                            <div class="flex flex-column gap-5" style="padding-top: 20px;">
                                <div class="flex flex-column gap-5">
                                    <div class="title-5">
                                        Size
                                    </div>
                                    <div class="sizes flex gap-20" style="padding-top: 20px;">
                                        <button type="button" class="size-option" data-size="XS">XS</button>
                                        <button type="button" class="size-option" data-size="S">S</button>
                                        <button type="button" class="size-option" data-size="M">M</button>
                                        <button type="button" class="size-option" data-size="L">L</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
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
    let selectedColor = null;
    let selectedSize = null;
    document.querySelectorAll('.color-option').forEach(function(button) {
        button.addEventListener(
            'click',
            function() {
                document.querySelectorAll('.color-option').forEach(function(item) {
                    item.classList.remove(
                        'selected'
                    );
                });
                this.classList.add('selected');
                selectedColor = this.dataset.color;
            }
        );
    });
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
    document.getElementById('add-to-cart').addEventListener('click', function() {
        if (!selectedColor) {
            alert(
                'Please select a color.'
            );
            return;
        }
        if (!selectedSize) {
            alert(
                'Please select a size.'
            );
            return;
        }
        const quantity = Number(document.getElementById('quantity').value) || 1;
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
        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart = JSON.parse(
            localStorage.getItem(
                cartKey
            )) || [];
        const existingProduct =
            cart.find(function(item) {
                return item.id == product.id &&
                    item.color == product.color &&
                    item.size == product.size;
            });
        if (existingProduct) {
            existingProduct.quantity =
                (Number(existingProduct.quantity) || 1) + product.quantity;
        } else {
            cart.push(product);
        }
        localStorage.setItem(
            cartKey,
            JSON.stringify(cart)
        );
        alert(
            'Product added to cart!'
        );
    });
    const favoritesKey = 'favorites_user_{{ auth()->id() }}';
    const favoriteButton = document.getElementById(
        'favorite-button'
    );
    const favoriteHeart = document.getElementById(
        'favorite-heart'
    );
    let favorites = JSON.parse(
        localStorage.getItem(
            favoritesKey
        )
    ) || [];
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
            favoriteHeart.style.color =
                '';
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
                return product.id ==
                    productId;
            }
        );
        if (index !== -1) {
            favorites.splice(
                index,
                1
            );
        } else {
            favorites.push({
                id: "{{ $product->id }}",
                title: "{{ $product->title }}",
                price: Number("{{ $product->price }}"),
                image: "{{ asset($product->image) }}"
            });
        }
        localStorage.setItem(favoritesKey, JSON.stringify(favorites));
        updateFavoriteHeart();
    });
</script>

@endsection