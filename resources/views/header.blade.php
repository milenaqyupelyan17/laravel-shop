<header>
    <section id="header">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center">
                    <a href="{{ route('home') }}">
                        <img class="logoImage" src="{{ asset('images/logo.png') }}" alt="Luminae">
                    </a>
                    <a href="{{ route('home') }}">
                        <div class="title-2 w-700">Luminae</div>
                    </a>
                </div>
            </div>
            <div class="col">
                <form action="{{ route('products') }}" method="GET" class="wrapper search-box flex align-items-center">
                    <input class="inpSearch" type="text" name="search" value="{{ request('search') }}" placeholder="Search Products">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            <nav class="nav flex gap-20">
                <a href="{{ route('about') }}">
                    <div class="text-grey">About us</div>
                </a>
                <a href="{{ route('contact') }}">
                    <div class="text-grey">Contact us</div>
                </a>
                <a href="{{ route('help') }}">
                    <div class="text-grey">Help & support</div>
                </a>
            </nav>
        </div>
    </section>
</header>