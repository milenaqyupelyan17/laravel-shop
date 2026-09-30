@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
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
                            <div class="title-6">
                                Card
                            </div>
                        </a>
                        <div
                            id="cart-items-count"
                            class="text-grey title-6">
                            0 products
                        </div>
                    </div>
                    <div id="cart-products"
                        class="cart-products-list">
                    </div>
                </div>
            </div>
            <div class="col w-50">
                <div class="wrapper bg-grey br">
                    <div class="wrapper bg-grey br order-summary">
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6">
                                Price
                            </div>
                            <div id="cart-price"
                                class="title-6">
                                $0
                            </div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="text-grey title-6">
                                Discount price
                            </div>
                            <div class="title-6">
                                $0
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="flex justify-content-between">
                            <div class="title-6 w-700">
                                Total Price
                            </div>
                            <div id="cart-total"
                                class="title-6 w-700 text-red">
                                $0
                            </div>
                        </div>
                        <a href="{{ route('payment') }}"
                            class="btn-1"
                            id="payment-button">
                            Start Order
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div id="editModal"
    class="edit-modal">
    <div class="edit-modal-overlay"></div>
    <div class="edit-modal-content">
        <button type="button"
            class="edit-modal-close"
            id="closeEditModal">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="edit-modal-header">

            <div>
                <div class="edit-modal-small-title">
                    YOUR CART
                </div>

                <div class="edit-modal-title">
                    Edit Product
                </div>
            </div>
        </div>
        <div class="edit-modal-product">
            <div class="edit-modal-image">
                <img id="editModalImage"
                    src=""
                    alt="Product">
            </div>
            <div class="edit-modal-info">
                <div id="editModalTitle"
                    class="edit-modal-product-title">
                </div>
                <div id="editModalPrice"
                    class="edit-modal-price">
                </div>
                <div class="edit-modal-description">
                    Update your product options
                    before continuing your order.
                </div>
            </div>
        </div>
        <div class="edit-modal-options">
            <div class="edit-option">

                <label>
                    Color
                </label>

                <select id="modalColor">

                    <option value="Red">
                        Red
                    </option>

                    <option value="Pink">
                        Pink
                    </option>
                    <option value="Blue">
                        Blue
                    </option>
                    <option value="Orange">
                        Orange
                    </option>
                    <option value="Yellow">
                        Yellow
                    </option>
                    <option value="Green">
                        Green
                    </option>
                </select>
            </div>
            <div class="edit-option">
                <label>
                    Size
                </label>
                <select id="modalSize">
                    <option value="XS">
                        XS
                    </option>
                    <option value="S">
                        S
                    </option>
                    <option value="M">
                        M
                    </option>
                    <option value="L">
                        L
                    </option>
                </select>
            </div>
            <div class="edit-option">
                <label>
                    Quantity
                </label>

                <div class="modal-quantity">
                    <button type="button"
                        id="modalMinus">
                        −
                    </button>
                    <input type="number"
                        id="modalQuantity"
                        min="1"
                        value="1">
                    <button type="button"
                        id="modalPlus">
                        +
                    </button>
                </div>
            </div>
        </div>
        <div class="edit-modal-actions">
            <button type="button"
                class="edit-cancel"
                id="cancelEdit">
                Cancel
            </button>
            <button type="button"
                class="edit-save"
                id="saveEdit">
                Save Changes
            </button>
        </div>
    </div>
</div>
<style>
    .edit-product {
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        text-decoration: underline;
        transition: opacity .2s ease;
    }

    .edit-product:hover {
        opacity: .55;
    }

    .edit-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .edit-modal.active {
        display: flex;
    }

    .edit-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .48);
        backdrop-filter: blur(4px);
    }



    .edit-modal-content {
        position: relative;
        width: 540px;
        max-width: calc(100% - 30px);
        background: #fff;
        padding: 32px;
        border-radius: 18px;
        box-shadow:
            0 25px 70px rgba(0, 0, 0, .18);
        animation: editModalShow .25s ease;
    }


    @keyframes editModalShow {

        from {
            opacity: 0;
            transform: translateY(20px) scale(.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }

    .edit-modal-close {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 34px;
        height: 34px;
        border: none;
        background: #f5f5f5;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
    }

    .edit-modal-close:hover {
        background: #eaeaea;
        transform: rotate(90deg);
    }

    .edit-modal-small-title {
        font-size: 11px;
        letter-spacing: 2px;
        color: #999;
        margin-bottom: 5px;
    }

    .edit-modal-title {
        font-size: 26px;
        font-weight: 600;
    }

    .edit-modal-product {
        display: flex;
        gap: 20px;
        margin-top: 28px;
        margin-bottom: 28px;

        padding-bottom: 25px;

        border-bottom: 1px solid #eeeeee;
    }


    .edit-modal-image {

        width: 100px;
        height: 120px;
        background: #f5f5f5;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }


    .edit-modal-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }


    .edit-modal-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }


    .edit-modal-product-title {

        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }


    .edit-modal-price {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }


    .edit-modal-description {
        color: #999;
        font-size: 13px;
        line-height: 1.5;
    }

    .edit-modal-options {

        display: flex;
        flex-direction: column;
        gap: 18px;
    }


    .edit-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }


    .edit-option label {

        font-size: 14px;

        font-weight: 600;
    }


    .edit-option select {

        width: 220px;

        height: 44px;

        border: 1px solid #dedede;

        border-radius: 8px;

        padding: 0 12px;

        background: #fff;

        font-family: inherit;

        cursor: pointer;

        outline: none;
    }


    .edit-option select:focus {

        border-color: #999;
    }

    .modal-quantity {
        display: flex;
        align-items: center;
        border: 1px solid #dedede;
        border-radius: 8px;
        overflow: hidden;
    }


    .modal-quantity button {

        width: 40px;
        height: 42px;
        border: none;
        background: #f7f7f7;
        cursor: pointer;
        font-size: 18px;
        transition: .2s;
    }


    .modal-quantity button:hover {
        background: #eeeeee;
    }


    .modal-quantity input {

        width: 55px;
        height: 42px;

        border: none;

        text-align: center;

        outline: none;

        font-family: inherit;
    }

    .modal-quantity input::-webkit-outer-spin-button,
    .modal-quantity input::-webkit-inner-spin-button {

        -webkit-appearance: none;
        margin: 0;
    }

    .edit-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #eeeeee;
    }


    .edit-cancel {
        height: 45px;
        padding: 0 22px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        transition: .2s;
    }


    .edit-cancel:hover {
        background: #f5f5f5;
    }


    .edit-save {
        height: 45px;
        padding: 0 25px;
        border: none;
        background: #111;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        transition: .2s;
    }


    .edit-save:hover {
        opacity: .85;
    }

    @media (max-width: 600px) {

        .edit-modal-content {
            padding: 24px;
        }

        .edit-modal-product {
            gap: 14px;
        }

        .edit-modal-image {
            width: 80px;
            height: 100px;
        }

        .edit-option {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
        }

        .edit-option select {
            width: 100%;
        }

        .modal-quantity {
            width: fit-content;
        }

        .edit-modal-actions {
            flex-direction: column-reverse;
        }

        .edit-cancel,
        .edit-save {
            width: 100%;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const cartKey = 'cart_user_{{ auth()->id() }}';

        let cart = JSON.parse(
            localStorage.getItem(cartKey)
        ) || [];


        const container =document.getElementById('cart-products');
        const priceElement =document.getElementById('cart-price');
        const totalElement =document.getElementById('cart-total');
        const itemsCountElement =document.getElementById('cart-items-count');
        const paymentButton =document.getElementById('payment-button');
        const editModal = document.getElementById('editModal');
        const closeEditModal =document.getElementById('closeEditModal');
        const cancelEdit =document.getElementById('cancelEdit');
        const saveEdit =document.getElementById('saveEdit');
        const modalColor =document.getElementById('modalColor');
        const modalSize =document.getElementById('modalSize');
        const modalQuantity =document.getElementById('modalQuantity');
        const modalMinus =document.getElementById('modalMinus');
        const modalPlus = document.getElementById('modalPlus');
        const modalImage = document.getElementById('editModalImage');
        const modalTitle = document.getElementById('editModalTitle');
        const modalPrice =document.getElementById('editModalPrice');

        let editingIndex = null;

        function updateHeaderCount() {

            const count = cart.reduce(function(
                total,
                product
            ) {

                return total +
                    (Number(product.quantity) || 1);

            }, 0);


            document
                .querySelectorAll(
                    '#cart-count, #card-header-count, .cart'
                )
                .forEach(function(element) {

                    if (
                        element.id ===
                        'card-header-count'
                    ) {

                        element.textContent =
                            'CARD(' + count + ')';

                    } else {

                        element.textContent =
                            count;
                    }

                });
        }

        function updateCart() {

            cart =
                JSON.parse(
                    localStorage.getItem(cartKey)
                ) || [];
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

                    <a
                        href="{{ route('products') }}"
                        class="btn-2">

                        Continue Shopping

                    </a>

                </div>

            `;

                priceElement.textContent = '$0';
                totalElement.textContent = '$0';
                itemsCountElement.textContent =
                    '0 products';
                return;
            }
            cart.forEach(function(
                product,
                index
            ) {

                product.quantity =
                    Number(product.quantity) || 1;

                product.price =
                    Number(product.price) || 0;


                const productTotal =
                    product.price *
                    product.quantity;


                total += productTotal;


                const card = document.createElement('div');

                card.className =
                    'cart-product';

                card.innerHTML = `
                <div class="cart-product-image">
                    <img
                        src="${product.image}"
                        alt="${product.title}"
                    >
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
            `;
                container.appendChild(card);
            });
            priceElement.textContent = '$' + total.toFixed(2);
            totalElement.textContent = '$' + total.toFixed(2);
            itemsCountElement.textContent = cart.length +
                (cart.length === 1 ?
                    ' product' :
                    ' products');
            addCartEvents();

        }

        function addCartEvents() {
            document.querySelectorAll('.cart-plus').forEach(function(button) {
                button.addEventListener(
                    'click',
                    function() {
                        const index =
                            Number(
                                this.dataset.index
                            );


                        cart[index].quantity =
                            (
                                Number(
                                    cart[index].quantity
                                ) || 1
                            ) + 1;


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

                        const index =
                            Number(
                                this.dataset.index
                            );

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

                       const index =
                            Number(
                                this.dataset.index
                            );
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

                button.addEventListener('click',function() {
                        editingIndex =
                            Number(
                                this.dataset.index
                            );
                        const product = cart[editingIndex];
                        if (!product) {
                            return;
                        }
                        modalImage.src = product.image;
                        modalImage.alt = product.title;
                        modalTitle.textContent =
                            product.title;
                        modalPrice.textContent =
                            '$' +
                            Number(
                                product.price
                            ).toFixed(2);
                        modalColor.value =
                            product.color ||
                            'Red';

                        modalSize.value = product.size ||'S';
                        modalQuantity.value = Number(
                                product.quantity
                            ) || 1;
                        editModal.classList.add(
                            'active'
                        );
                        document.body.style.overflow =
                            'hidden';
                    }
                );

            });

        }

        function closeModal() {
            editModal.classList.remove(
                'active'
            );
            document.body.style.overflow =
                '';
            editingIndex = null;
        }
        closeEditModal.addEventListener('click', closeModal);
        cancelEdit.addEventListener(
            'click',
            closeModal
        );
        document.querySelector('.edit-modal-overlay').addEventListener(
            'click',
            closeModal
        );
        document.addEventListener('keydown', function(event) {
            if (
                event.key === 'Escape' &&
                editModal.classList.contains(
                    'active'
                )
            ) {
                closeModal();
            }
        });

        modalMinus.addEventListener('click', function() {
            let quantity = Number(
                modalQuantity.value
            ) || 1;
            if (quantity > 1) {
                quantity--;
            }
            modalQuantity.value = quantity;
        });
        modalPlus.addEventListener('click', function() {
            let quantity = Number(
                modalQuantity.value
            ) || 1;
            quantity++;
            modalQuantity.value = quantity;
        });

        saveEdit.addEventListener('click', function() {

            if (editingIndex === null) {
                return;
            }
            const color = modalColor.value;
            const size = modalSize.value;
            let quantity = Number(
                modalQuantity.value
            );
            if (
                !quantity ||
                quantity < 1
            ) {
                quantity = 1;
            }

            cart[editingIndex].color = color;
            cart[editingIndex].size = size;
            cart[editingIndex].quantity = quantity;
            localStorage.setItem(
                cartKey,
                JSON.stringify(cart)
            );
            closeModal();
            updateCart();
        });

        if (paymentButton) {
            paymentButton.addEventListener('click', function(event) {
                const currentCart = JSON.parse(
                    localStorage.getItem(
                        cartKey)) || [];
                if (currentCart.length === 0) {
                    event.preventDefault();
                    alert(
                        'Your cart is empty. Please add a product first.'
                    );
                }
            });
        }
        updateCart();
    });
</script>

@endsection