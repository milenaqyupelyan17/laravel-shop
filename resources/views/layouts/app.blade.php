<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    @include('header')

    @yield('content')
    @if(
    request()->routeIs('home') ||
    request()->routeIs('products') ||
    request()->routeIs('about') ||
    request()->routeIs('contact')
    )
    @include('letter')
    @endif

    @include('footer')
    <script>
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function() {
                const cartKey = 'cart_user_{{ auth()->id() }}';
                localStorage.removeItem(cartKey);

            });
        }
    </script>
    <script>
        const userId = "{{ auth()->id() }}";
    </script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartKey = 'cart_user_{{ auth()->id() }}';

            function updateCartCount() {
                const cart = JSON.parse(
                    localStorage.getItem(cartKey)
                ) || [];
                let totalQuantity = 0;
                cart.forEach(function(product) {
                    totalQuantity += Number(product.quantity) || 1;
                });
                document.querySelectorAll('#cart-count').forEach(function(element) {
                    element.textContent = totalQuantity;
                });
                document.querySelectorAll('#card-header-count').forEach(function(element) {
                    element.textContent = 'CARD(' + totalQuantity + ')';
                });
                document.querySelectorAll('.cart').forEach(function(element) {
                    element.textContent = totalQuantity;
                });
            }
            updateCartCount();
        });
    </script>
</body>

</html>