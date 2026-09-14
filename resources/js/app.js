document.addEventListener('DOMContentLoaded', () => {

    const hearts = document.querySelectorAll('.add-to-cart');
    const cartCount = document.getElementById('cart-count');

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function updateCartCount() {
        cartCount.textContent = cart.length;
    }

    hearts.forEach((heart) => {
        heart.addEventListener('click', () => {
            cart.push(1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();

        });

    });

    updateCartCount();
});