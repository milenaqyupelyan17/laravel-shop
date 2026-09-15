@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Products</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="products-blade">
        <div class="row gap-20 align-items-start">
            <aside class="col w-20">
                <div class="wrapper bg-grey br">
                    <div class="flex flex-column gap-20"
                        style="padding: 24px; border: 1px solid #e5e5e5; background: #fff;">

                        <div class="title-5 w-700"
                            style="font-size: 20px; letter-spacing: 0.5px; padding-bottom: 15px; border-bottom: 1px solid #e5e5e5;">
                            Filter
                        </div>

                        <form action="{{ route('products') }}"
                            method="GET"
                            class="flex flex-column gap-20">

                            <!-- Color -->
                            <div class="flex flex-column gap-10">

                                <div class="title-6 w-700"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #555; margin-bottom: 5px;">
                                    Color
                                </div>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="color"
                                        value="Red"
                                        {{ request('color') == 'Red' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    Red
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="color"
                                        value="Blue"
                                        {{ request('color') == 'Blue' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    Blue
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="color"
                                        value="Green"
                                        {{ request('color') == 'Green' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    Green
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="color"
                                        value="Pink"
                                        {{ request('color') == 'Pink' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    Pink
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="color"
                                        value="Black"
                                        {{ request('color') == 'Black' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    Black
                                </label>

                            </div>

                            <!-- Size -->
                            <div class="flex flex-column gap-10"
                                style="padding-top: 5px;">

                                <div class="title-6 w-700"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #555; margin-bottom: 5px;">
                                    Size
                                </div>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="size"
                                        value="XS"
                                        {{ request('size') == 'XS' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    XS
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="size"
                                        value="S"
                                        {{ request('size') == 'S' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    S
                                </label>

                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio"
                                        name="size"
                                        value="M"
                                        {{ request('size') == 'M' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    M
                                </label>
                                <label class="title-6"
                                    style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #444;">
                                    <input type="radio" name="size"
                                        value="L"
                                        {{ request('size') == 'L' ? 'checked' : '' }}
                                        style="width: 15px; height: 15px; accent-color: #222; cursor: pointer;">
                                    L
                                </label>
                            </div>
                            <div class="flex flex-column" style="padding-top: 5px; gap:10px">
                                <button type="submit" class="btn-1"
                                    style="width: 100%; height: 44px; border: 1px solid 4172DC2; background: #4172DC; color: #fff; font-size: 13px; letter-spacing: 1px; cursor: pointer; transition: 0.2s;">
                                    APPLY FILTER
                                </button>
                                <a href="{{ route('products') }}" class="btn-1 text-center"
                                    style="width: 100%; height: 44px; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; background: transparent; color: #333; font-size: 13px; letter-spacing: 1px; text-decoration: none;">
                                    CLEAR FILTER
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>
            <div class="col w-80">
                <div class="products-grid gap-20">
                    @forelse($products as $product)
                    <div class="product-card">
                        <a href="{{ route('productdetails', ['id' => $product->id]) }}">
                            <div class="product-image">
                                <img src="{{ asset($product->image) }}"
                                    alt="{{ $product->title }}">
                            </div>
                        </a>
                        <div class="product-info">
                            <div>
                                <h2 class="title-7 w-700">
                                    {{ $product->title }}
                                </h2>
                                <p class="text-grey title-8">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="products-info">
                                <div class="price text-red">
                                    ${{ $product->price }}
                                </div>
                                <i
                                    class="fa-regular fa-heart favorite-btn"
                                    data-id="{{ $product->id }}"
                                    data-title="{{ $product->title }}"
                                    data-price="{{ $product->price }}"
                                    data-image="{{ asset($product->image) }}"></i>
                            </div>
                            <button
                                type="button"
                                class="btn-1 add-product-cart"
                                data-id="{{ $product->id }}"
                                data-title="{{ $product->title }}"
                                data-price="{{ $product->price }}"
                                data-image="{{ asset($product->image) }}"
                                data-color="{{ $product->color }}"
                                data-size="{{ $product->size }}">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="title-5">
                        No products found.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <div id="cart-toast" class="cart-toast"></div>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';

        function showToast(message) {
            const toast = document.getElementById('cart-toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 2000);
        }
        document.querySelectorAll('.add-product-cart').forEach(function(button) {
            button.addEventListener('click', function() {
                const product = {
                    id: this.dataset.id,
                    title: this.dataset.title,
                    price: Number(this.dataset.price),
                    image: this.dataset.image,
                    quantity: 1,
                    color: this.dataset.color,
                    size: this.dataset.size
                };
                let cart = JSON.parse(
                    localStorage.getItem(cartKey)
                ) || [];
                const existingProduct = cart.find(function(item) {
                    return item.id == product.id &&
                        item.color == product.color &&
                        item.size == product.size;
                });
                if (existingProduct) {
                    existingProduct.quantity++;
                } else {
                    cart.push(product);
                }
                localStorage.setItem(
                    cartKey,
                    JSON.stringify(cart)
                );
                let totalQuantity = 0;
                cart.forEach(function(item) {
                    totalQuantity += Number(item.quantity) || 0;
                });
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = totalQuantity;
                }
                showToast('✓ Product added to cart!');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const favoriteKey = 'favorites_user_{{ auth()->id() }}';
        let favorites =
            JSON.parse(localStorage.getItem(favoriteKey)) || [];
        document.querySelectorAll('.favorite-btn').forEach(function(heart) {
            const productId = heart.dataset.id;
            const exists = favorites.some(function(product) {
                return product.id == productId;
            });
            if (exists) {
                heart.classList.remove('fa-regular');
                heart.classList.add('fa-solid');
            }
            heart.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                let favorites = JSON.parse(localStorage.getItem(favoriteKey)) || [];
                const index = favorites.findIndex(function(product) {
                    return product.id == productId;
                });
                if (index !== -1) {
                    favorites.splice(index, 1);
                    heart.classList.remove('fa-solid');
                    heart.classList.add('fa-regular');
                } else {
                    const product = {
                        id: this.dataset.id,
                        title: this.dataset.title,
                        price: Number(this.dataset.price),
                        image: this.dataset.image
                    };
                    favorites.push(product);
                    heart.classList.remove('fa-regular');
                    heart.classList.add('fa-solid');
                }
                localStorage.setItem(
                    favoriteKey,
                    JSON.stringify(favorites)
                );
            });
        });
    });
</script>

@endsection