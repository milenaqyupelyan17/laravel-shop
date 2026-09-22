<header>

    <section id="header">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center">
                    <a href="{{ route('home') }}">
                        <img class="logoImage"
                            src="{{ asset('images/logo.png') }}"
                            alt="Luminae">
                    </a>
                    <a href="{{ route('home') }}">
                        <div class="title-2 w-700">
                            Luminae
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <form
                    action="{{ route('products') }}"
                    method="GET"
                    class="wrapper search-box flex align-items-center"
                    id="search-form">
                    <input
                        class="inpSearch"
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search Products">
                    <i class="fa-solid fa-magnifying-glass"
                        id="search-button"
                        style="cursor:pointer;">
                    </i>
                </form>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <div class="flex gap-5 align-items-center">
                        @auth
                        <a href="{{ route('dashboard') }}">
                            <div class="title-6">
                                Dashboard
                            </div>
                        </a>
                        @else
                        <i class="fa-regular fa-user"></i>
                        <a href="{{ route('login') }}">
                            <div class="title-6">
                                Sign in
                            </div>
                        </a>
                        @endauth
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-heart"></i>
                        <a href="{{ route('favorites') }}">
                            <div class="title-6">
                                Favorites
                            </div>
                        </a>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <a href="{{ route('carts') }}"
                            style="
                                display:flex;
                                align-items:center;
                                gap:3px;
                                white-space:nowrap;">
                            <span>
                                Cart
                            </span>
                            <span
                                id="cart-count"
                                style="
                                    display:inline-block;
                                    width:25px;
                                    min-width:25px;
                                    text-align:left;">
                                0
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart = JSON.parse(
            localStorage.getItem(cartKey)) || [];
        let totalQuantity = 0;
        cart.forEach(function(item) {
            totalQuantity += Number(item.quantity) || 0;
        });
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = totalQuantity;
        }

    });
</script>