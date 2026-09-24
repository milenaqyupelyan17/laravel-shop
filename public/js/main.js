const searchInput = document.querySelector('.inpSearch');

if (searchInput) {

    searchInput.addEventListener('input', function () {
        if (this.value.trim() === '') {
            window.location.href = "/products";
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(newsletterForm);
            fetch(newsletterForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json()).then(data => {
                    if (data.success) {
                        newsletterForm.reset();
                        const notify = document.createElement('div');
                        notify.className = 'newsletter-notify';
                        notify.innerHTML = '✓ ' + data.message;
                        document.body.appendChild(notify);

                        setTimeout(function () {
                            notify.remove();
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    }
});

function updateCartCount() {
    const cartKey = 'cart_user_' + userId;
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
    let totalQuantity = cart.reduce(function (total, product) {
        return total + (Number(product.quantity) || 0);
    }, 0);
    const cartCount = document.getElementById('cart-count');

    if (cartCount) {
        cartCount.textContent = totalQuantity;
    }
    document.querySelectorAll('#card-header-count').forEach(function (element) {
        element.textContent = 'CARD(' + totalQuantity + ')';
    });
}
window.addEventListener('beforeunload', function () {
    sessionStorage.setItem('scrollPosition', window.scrollY);
});

window.addEventListener('load', function () {
    const scrollPosition = sessionStorage.getItem('scrollPosition');

    if (scrollPosition !== null) {
        window.scrollTo(0, parseInt(scrollPosition));
        sessionStorage.removeItem('scrollPosition');
    }
});