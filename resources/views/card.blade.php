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
                        <span>Card</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="cart">
        <div class="row" style="gap:20px">
            <div class="col w-50">
                <div class="wrapper">
                    <div class="flex justify-content-between align-items-center">
                        <a href="{{ route('card') }}">
                            <div class="title-6">Card</div>
                        </a>
                        <div id="cart-items-count" class="text-grey title-6">0 products</div>
                    </div>
                    <div id="cart-products" class="cart-products-list"></div>
                </div>
            </div>
            <div class="col w-50">
                <div class="wrapper bg-grey br">
                    <div class="wrapper bg-grey br order-summary">
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6">Price</div>
                            <div id="cart-price" class="title-6">$0</div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6">Discount price</div>
                            <div class="title-6">$0</div>
                        </div>
                        <div class="line"></div>
                        <div class="flex justify-content-between">
                            <div class="title-6 w-700"> Total Price</div>
                            <div id="cart-total" class="title-6 w-700 text-red">$0</div>
                        </div>
                        <a href="{{ route('payment') }}"
                            class="btn-1"
                            id="payment-button">
                            Shop now
                        </a>
                    </div>
                </div>
            </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart = JSON.parse(
            localStorage.getItem(cartKey)
        ) || [];
        const cartCountElement = document.getElementById('cart-count');
        const container = document.getElementById('cart-products');
        const priceElement = document.getElementById('cart-price');
        const totalElement = document.getElementById('cart-total');
        const itemsCountElement = document.getElementById('cart-items-count');

        function updateCart() {
            cart = JSON.parse(
                localStorage.getItem(cartKey)
            ) || [];
            container.innerHTML = '';
            let total = 0;
            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="empty-cart">
                        <div class="title-4">
                            Your cart is empty
                        </div>
                        <p class="text-grey title-6">
                            Add products to your cart.
                        </p>
                        <a href="{{ route('products') }}"
                           class="btn-2">
                            Continue Shopping
                        </a>
                    </div>
                `;
                priceElement.textContent = '$0';
                totalElement.textContent = '$0';
                if (cartCountElement) {
                    cartCountElement.textContent = cart.length;
                }
                itemsCountElement.textContent = '0 products';
                return;
            }
            cart.forEach(function(product) {
                product.quantity = Number(product.quantity) || 1;
                product.price = Number(product.price) || 0;
                const productTotal = product.price * product.quantity;
                total += productTotal;
                const card = document.createElement('div');
                card.className = 'cart-product';
                card.innerHTML = `
                    <div class="cart-product-image">
                        <img src="${product.image}" alt="${product.title}" >
                    </div>
                    <div class="cart-product-info">
                        <div>
                            <div class="title-6 w-700">
                                ${product.title}
                            </div>
                            <div class="text-grey title-6">
                                $${product.price.toFixed(2)}
                            </div>
                        </div>
                        <div class="quantity">
                            <button
                                type="button"
                                class="cart-minus"
                                data-id="${product.id}"
                                data-color="${product.color || ''}"
                                data-size="${product.size || ''}">
                                -
                            </button>
                            <span class="quantity-number">
                                ${product.quantity}
                            </span>
                            <button
                                type="button"
                                class="cart-plus"
                                data-id="${product.id}"
                                data-color="${product.color || ''}"
                                data-size="${product.size || ''}">
                                +
                            </button>
                        </div>
                        <div class="title-6 w-700">
                            $${productTotal.toFixed(2)}
                        </div>
                        <button
                            type="button"
                            class="cart-remove"
                            data-id="${product.id}"
                            data-color="${product.color || ''}"
                            data-size="${product.size || ''}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
            priceElement.textContent = '$' + total.toFixed(2);
            totalElement.textContent = '$' + total.toFixed(2);
            if (cartCountElement) {
                cartCountElement.textContent = cart.length;
            }
            itemsCountElement.textContent = cart.length +
                (cart.length === 1 ?
                    ' product' :
                    ' products');
            addCartEvents();
        }

        function addCartEvents() {
            document.querySelectorAll('.cart-plus').forEach(function(button) {
                button.addEventListener('click', function() {
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
                        product.quantity = (Number(product.quantity) || 1) + 1;
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        updateCart();
                    }
                });
            });
            document.querySelectorAll('.cart-minus').forEach(function(button) {
                button.addEventListener('click', function() {
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
                        if (
                            Number(product.quantity) > 1
                        ) {
                            product.quantity--;
                        } else {
                            cart = cart.filter(function(item) {
                                return !(
                                    item.id == id &&
                                    item.color == color &&
                                    item.size == size
                                );
                            });
                        }
                        localStorage.setItem(cartKey, JSON.stringify(cart));
                        updateCart();
                    }
                });
            });
            document.querySelectorAll('.cart-remove').forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const color = this.dataset.color;
                    const size = this.dataset.size;
                    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
                    cart = cart.filter(function(item) {
                        return !(
                            item.id == id &&
                            item.color == color &&
                            item.size == size
                        );
                    });
                    localStorage.setItem(
                        cartKey,
                        JSON.stringify(cart)
                    );
                    updateCart();
                });
            });
        }
        updateCart();
        const paymentButton = document.getElementById('payment-button');
        paymentButton.addEventListener('click', function(event) {
            let cart = JSON.parse(
                localStorage.getItem(cartKey)
            ) || [];
            if (cart.length === 0) {
                event.preventDefault();
                alert('Your cart is empty. Please add a product first.');
            }
        });
    });
</script>

@endsection