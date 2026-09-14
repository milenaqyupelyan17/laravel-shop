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
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalQuantity = 0;
            cart.forEach(function(product) {
                totalQuantity += Number(product.quantity) || 1;
            });
            let cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = totalQuantity;
            }
        }
        updateCartCount();
    </script>
</body>

</html>