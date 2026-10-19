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

    if (!newsletterForm) return;

    newsletterForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const button = newsletterForm.querySelector('button[type="submit"]');
        const originalText = button ? button.textContent : '';

        if (button) {
            button.disabled = true;
            button.textContent = 'Sending...';
        }

        try {
            const response = await fetch(newsletterForm.action, {
                method: 'POST',
                body: new FormData(newsletterForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            let notify = document.querySelector('.newsletter-notify');

            if (!notify) {
                notify = document.createElement('div');
                notify.className = 'newsletter-notify';
                newsletterForm.insertAdjacentElement('afterend', notify);
            }

            notify.textContent = (data.success ? '✓ ' : '⚠ ') + data.message;
            notify.style.cssText = `
                display: block;
                margin-top: 12px;
                padding: 12px 16px;
                border-radius: 4px;
                font-size: 14px;
                color: ${data.success ? '#ffffff' : '#ffd6d6'};
                background: ${data.success ? '#245b42' : '#742d2d'};
            `;

            if (data.success) {
                newsletterForm.reset();
            }
        } catch (error) {
            console.error('Newsletter error:', error);
            alert('Something went wrong. Please try again.');
        } finally {
            if (button) {
                button.disabled = false;
                button.textContent = originalText;
            }
        }
    });
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