const searchInput = document.querySelector('.inpSearch');

if (searchInput) {
    searchInput.addEventListener('input', function () {
        if (this.value.trim() === '') {
            window.location.href = "/products";
        }
    });

}

document.addEventListener('DOMContentLoaded', function () {
    let favorites =
        JSON.parse(localStorage.getItem('favorites')) || [];
    document.querySelectorAll('.favorite-btn')
        .forEach(function (heart) {
            const productId = heart.dataset.id;
            if (
                favorites.some(function (product) {
                    return product.id == productId;
                })
            ) {
                heart.classList.remove('fa-regular');
                heart.classList.add('fa-solid');
                heart.style.color = 'red';
            }
            heart.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const product = {
                    id: this.dataset.id,
                    title: this.dataset.title,
                    price: this.dataset.price,
                    image: this.dataset.image
                };
                const existingIndex =
                    favorites.findIndex(function (item) {
                        return item.id == product.id;
                    });
                if (existingIndex === -1) {
                    product.quantity = 1;
                    favorites.push(product);
                    this.classList.remove('fa-regular');
                    this.classList.add('fa-solid');
                    this.style.color = 'red';
                }
                else {
                    favorites.splice(existingIndex, 1);
                    this.classList.remove('fa-solid');
                    this.classList.add('fa-regular');
                    this.style.color = '';
                }
                localStorage.setItem(
                    'favorites',
                    JSON.stringify(favorites)
                );
            });
        });
    updateCartCount();
});
function updateCartCount() {
    let cart =
        JSON.parse(localStorage.getItem('cart')) || [];
    let totalQuantity =
        cart.reduce(function (total, product) {
            return total +
                (Number(product.quantity) || 1);
        }, 0);
    const cartCount =
        document.getElementById('cart-count');
    if (cartCount) {
        cartCount.textContent =
            totalQuantity;
    }
}