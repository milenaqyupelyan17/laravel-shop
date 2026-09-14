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
        <div class="row">
            <div class="col w-60">
                <div class="wrapper">
                    <div class="flex justify-content-between align-items-center">
                        <a href="{{ route('card') }}"><div class="title-6">Card</div></a>
                        <div id="cart-items-count" class="text-grey title-6">0 products</div>
                    </div>
                    <div id="cart-products" class="cart-products-list"></div>
                </div>
            </div>
            <div class="col w-40">
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
                        <a href="{{ route('payment') }}" class="btn-1">Shop now</a>
                    </div>
                </div>
            </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const container = document.getElementById('cart-products');
        const priceElement = document.getElementById('cart-price');
        const totalElement = document.getElementById('cart-total');
        const cartCountElement = document.getElementById('cart-count');
        const itemsCountElement = document.getElementById('cart-items-count');
        let total = 0;
        let totalQuantity = 0;
        if (cart.length === 0) {
            container.innerHTML = `
            <div class="empty-cart">
                <div class="title-4">Your cart is empty</div>
                <p class="text-grey title-6">Add products to your cart.</p>
                <a href="{{ route('products') }}" class="btn-2"> Continue Shopping</a>
            </div> `;
            priceElement.textContent = '$0';
            totalElement.textContent = '$0';
            cartCountElement.textContent = '0';
            itemsCountElement.textContent = '0 products';
            return;
        }
        cart.forEach(function(product) {
            product.quantity = Number(product.quantity) || 1;
            const productTotal = Number(product.price) * product.quantity;
            total += productTotal;
            totalQuantity += product.quantity;
            const card = document.createElement('div');
            card.className = 'cart-product';
            card.innerHTML = `
            <div class="cart-product-image">
                <img src="${product.image}" alt="${product.title}">
            </div>
            <div class="cart-product-info">
                <div>
                    <div class="title-6 w-700">
                        ${product.title}
                    </div>
                    <div class="text-grey title-6">
                        $${product.price}
                    </div>
                </div>
                <div class="quantity">
                    <button type="button" class="cart-minus" data-id="${product.id}">-</button>
                    <span class="quantity-number">${product.quantity}</span>
                    <button type="button" class="cart-plus" data-id="${product.id}">+</button>
                </div>
                <div class="title-6 w-700">
                    $${productTotal.toFixed(2)}
                </div>
                <button type="button" class="cart-remove" data-id="${product.id}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>`;
            container.appendChild(card);
        });
        priceElement.textContent = '$' + total.toFixed(2);
        totalElement.textContent = '$' + total.toFixed(2);
        cartCountElement.textContent = totalQuantity;
        itemsCountElement.textContent =
            totalQuantity +
            (totalQuantity === 1 ?
                ' product' :
                ' products'
            );
        document.querySelectorAll('.cart-plus').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const product =
                    cart.find(function(item) {
                        return item.id == id;
                    });
                if (product) {
                    product.quantity =
                        (Number(product.quantity) || 1) + 1;
                    localStorage.setItem(
                        'cart',
                        JSON.stringify(cart)
                    );
                    location.reload();
                }
            });
        });
        document.querySelectorAll('.cart-minus').forEach(function(button) {

            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const product = cart.find(function(item) {
                    return item.id == id;
                });
                if (product && Number(product.quantity) > 1) {
                    product.quantity--;
                    localStorage.setItem(
                        'cart',
                        JSON.stringify(cart)
                    );
                    location.reload();
                }
            });
        });
        document.querySelectorAll('.cart-remove').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart = cart.filter(function(product) {
                    return product.id != id;
                });
                localStorage.setItem('cart', JSON.stringify(cart));
                location.reload();
            });
        });
    });
</script>
@endsection