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
                            Start Order
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

        const container = document.getElementById('cart-products');
        const priceElement = document.getElementById('cart-price');
        const totalElement = document.getElementById('cart-total');
        const itemsCountElement = document.getElementById('cart-items-count');
        const paymentButton = document.getElementById('payment-button');

        function updateHeaderCount() {
            const count = cart.reduce(function(total, product) {
                return total + (Number(product.quantity) || 1);
            }, 0);
            document.querySelectorAll('#cart-count, #card-header-count, .cart').forEach(function(element) {
                if (element.id === 'card-header-count') {
                    element.textContent =
                        'CARD(' + count + ')';
                } else {
                    element.textContent = count;
                }
            });
        }

        function updateCart() {
            cart = JSON.parse(localStorage.getItem(cartKey)) || [];
            container.innerHTML = '';
            let total = 0;
            updateHeaderCount();
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
                </div>`;
                priceElement.textContent = '$0';
                totalElement.textContent = '$0';
                itemsCountElement.textContent =
                    '0 products';
                return;
            }
            cart.forEach(function(product, index) {
                product.quantity = Number(product.quantity) || 1;
                product.price = Number(product.price) || 0;

                const productTotal = product.price * product.quantity;
                total += productTotal;
                const card = document.createElement('div');
                card.className ='cart-product';
                card.innerHTML = `
                <div class="cart-product-image">
                    <img
                        src="${product.image}"
                        alt="${product.title}">
                </div>
                <div class="cart-product-info">
                    <div>
                        <div class="title-6 w-700">
                            ${product.title}
                        </div>
                        <div class="text-grey title-6">
                            $${product.price.toFixed(2)}
                        </div>
                        <div class="text-grey title-7">
                            Color:
                            ${product.color || 'Not selected'}
                        </div>
                        <div class="text-grey title-7">
                            Size:
                            ${product.size || 'Not selected'}
                        </div>
                    </div>
                    <div class="quantity">
                        <button
                            type="button"
                            class="cart-minus"
                            data-index="${index}">
                            -
                        </button>
                        <span class="quantity-number">
                            ${product.quantity}
                        </span>
                        <button
                            type="button"
                            class="cart-plus"
                            data-index="${index}">
                            +
                        </button>
                    </div>
                    <div class="title-6 w-700">
                        $${productTotal.toFixed(2)}
                    </div>
                    <div class="cart-actions">
                        <button
                            type="button"
                            class="edit-product"
                            data-index="${index}">
                            Edit
                        </button>
                        <button
                            type="button"
                            class="cart-remove"
                            data-index="${index}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div
                    class="edit-product-box"
                    id="edit-${index}"
                    style="display:none;">
                    <div class="title-6 w-700">
                        Edit Product
                    </div>
                    <div class="edit-row">
                        <label>
                            Color
                        </label>
                        <select
                            class="edit-color"
                            data-index="${index}">
                            <option value="Red"
                                ${product.color === 'Red' ? 'selected' : ''}>
                                Red
                            </option>
                            <option value="Pink"
                                ${product.color === 'Pink' ? 'selected' : ''}>
                                Pink
                            </option>
                            <option value="Blue"
                                ${product.color === 'Blue' ? 'selected' : ''}>
                                Blue
                            </option>
                            <option value="Orange"
                                ${product.color === 'Orange' ? 'selected' : ''}>
                                Orange
                            </option>
                            <option value="Yellow"
                                ${product.color === 'Yellow' ? 'selected' : ''}>
                                Yellow
                            </option>
                            <option value="Green"
                                ${product.color === 'Green' ? 'selected' : ''}>
                                Green
                            </option>
                        </select>
                    </div>
                    <div class="edit-row">
                        <label>
                            Size
                        </label>
                        <select
                            class="edit-size"
                            data-index="${index}">
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
                    </div>
                    <div class="edit-row">
                        <label>
                            Quantity
                        </label>
                        <input
                            type="number"
                            min="1"
                            value="${product.quantity}"
                            class="edit-quantity"
                            data-index="${index}">
                    </div>
                    <button
                        type="button"
                        class="btn-1 save-edit"
                        data-index="${index}">
                        Save Changes
                    </button>
                </div>
            `;
                container.appendChild(card);
            });

            priceElement.textContent = '$' + total.toFixed(2);
            totalElement.textContent = '$' + total.toFixed(2);
            itemsCountElement.textContent =
                cart.length + (cart.length === 1 ? ' product' : ' products');
            addCartEvents();
        }

        function addCartEvents() {
            document.querySelectorAll('.cart-plus').forEach(function(button) {
                button.addEventListener('click', function() {
                        const index = Number(this.dataset.index);
                        cart[index].quantity = (Number(cart[index].quantity) || 1) + 1;
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        updateCart();
                    }
                );
            });
            document.querySelectorAll('.cart-minus').forEach(function(button) {
                button.addEventListener(
                    'click',
                    function() {
                        const index = Number(this.dataset.index);
                        if (
                            Number(
                                cart[index].quantity
                            ) > 1
                        ) {
                            cart[index].quantity--;
                        }
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        updateCart();
                    }
                );
            });
            document.querySelectorAll('.cart-remove').forEach(function(button) {
                button.addEventListener('click',function() {
                        const index = Number(this.dataset.index);
                        cart.splice(index, 1);
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        updateCart();
                    }
                );
            });
            document.querySelectorAll('.edit-product').forEach(function(button) {
                button.addEventListener('click', function() {
                    const index = this.dataset.index;
                    const editBox = document.getElementById('edit-' + index);
                    if (
                        editBox.style.display === 'none'
                    ) {
                        editBox.style.display = 'block';
                    } else {
                        editBox.style.display = 'none';
                    }
                });
            });
            document.querySelectorAll('.save-edit').forEach(function(button) {
                button.addEventListener('click',function() {
                        const index = Number(this.dataset.index);
                        const color = document.querySelector(`.edit-color[data-index="${index}"]`).value;
                        const size = document.querySelector(`.edit-size[data-index="${index}"]`).value;
                        const quantity = Number(document.querySelector(`.edit-quantity[data-index="${index}"]`).value);
                        cart[index].color = color;
                        cart[index].size = size;
                        cart[index].quantity = quantity >= 1 ? quantity : 1;
                        localStorage.setItem(
                            cartKey,
                            JSON.stringify(cart)
                        );
                        updateCart();
                    }
                );
            });
        }
        if (paymentButton) {
            paymentButton.addEventListener('click',function(event) {
                    const currentCart = JSON.parse(localStorage.getItem(cartKey)) || [];
                    if (currentCart.length === 0) {
                        event.preventDefault();
                        alert(
                            'Your cart is empty. Please add a product first.'
                        );
                    }
                }
            );
        }
        updateCart();
    });
</script>

@endsection