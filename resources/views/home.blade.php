@extends('layouts.app')

@section('content')
<main>
    <section class="banner bg-black w-100">
        <div class=" row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <a href="{{ route('categories') }}">
                        <div class="title-5 w-700">Categories</div>
                    </a>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <a href="{{ route('login') }}">
                            <div class="title-6">Sign in</div>
                        </a>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-heart add-to-cart"></i>
                        <a href="{{ route('favorites') }}">
                            <div class="title-6">Favorites</div>
                        </a>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <a href="{{ route('card') }}">
                            <div class="title-6">Card</div>
                        </a>
                        <span id="cart-count" class="cart title-7">0</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="categories">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-between">
                    <a href="{{ route('categories') }}">
                        <div class="text-orange title-6">Woman</div>
                    </a>
                    <a href="{{ route('categories') }}">
                        <div class="text-grey title-6">Best seller</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="hero">
        <div class="row">
            <div class="col w-50">
                <div class="wrapper flex justify-content-center">
                    <img src="{{ asset('images/hero-left.jpg') }}" alt="Summer collection">
                    <img src="{{ asset('images/hero-right.png') }}" alt="Blue Background">
                    <div class="hero-content">
                        <div class="title-2 w-700 text-white">KIMONOS, CAFTANS & PAREOS</div>
                        <div class="title-3 w-500 text-white">Poolside glam included From $4.99</div>
                        <a href="{{ route('products') }}">
                            <div class="btn-1 text-white">
                                <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                                SHOP NOW
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-promo">
            <div class="title-5 w-700">Summer Essentials</div>
            <div class="title-5 w-700 text-red">20% off</div>
            <div class="title-6 bg-black">19 Jul-30 Jul</div>
        </div>
    </section>
    <section id="must_have">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-between align-items-center">
                    <a href="{{ route('products') }}">
                        <div class="title-3">Trending must-haves</div>
                    </a>
                    <a href="{{ route('products') }}">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="products">
        <div class="row gap-5">
            @foreach($mustHaveProducts as $product)
            <div class="col">
                <div class="wrapper product-card">
                    <img src="{{ asset($product->image) }}"
                        alt="{{ $product->title }}">
                    <div class="product-info">
                        <div>
                            <div class="w-700">
                                {{ $product->title }}
                            </div>
                            <div class="title-6 text-grey">
                                {{ $product->description }}
                            </div>
                        </div>
                        <a href="{{ route('productdetails', ['id' => $product->id]) }}">
                            <div class="btn-2 w-700 title-6">
                                ${{ $product->price }} Shop Now
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section id="top">
        <div class="row">
            <div class="col w-100 align-items-center">
                <div class="wrapper flex justify-content-between align-items-center">
                    <a href="{{ route('products') }}">
                        <div class="title-3">Top100</div>
                    </a>
                    <a href="{{ route('products') }}">
                        View All
                    </a>
                </div>
            </div>
        </div>
        <div class="products-grid">
            @foreach($products as $product)
            <div class="top-products">
                <div class="products-image">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                </div>
                <div class="products-info">
                    <div>
                        <h2 class="title-7 w-700">
                            {{ $product->title }}
                        </h2>
                        <p class="text-grey title-8">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="products-info">
                        <div class="price text-red">
                            ${{ $product->price }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section id="banner-2">
        <div class="row">
            <div class="col bg-red">
                <div class="wrapper-color p-top">
                    <div class="title-1 text-white">Never-Ending Summer</div>
                    <div class="title-3 text-white">Throwback Shirts & all-day dressed</div>
                    <a href="{{ route('products') }}">
                        <div class="title-5 text-white">Explore all category</div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <img src="{{ asset('images/rectangle-1.png') }}">
                </div>
            </div>
            <div class="col bg-green">
                <div class="wrapper-color">
                    <div class="title-1 text-white">The most famous sport brands</div>
                    <div class="title-3 text-white">Get in gym essentials</div>
                    <a href="{{ route('products') }}">
                        <div class="title-5 text-white">Explore all category</div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <img src="{{ asset('images/rectangle-2.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="magsafe">
        <div class="row bg-beige">
            <div class="col">
                <div class="wrapper">
                    <div class="title-4">MAGSAFE</div>
                    <div class="title-5">Snap on a magnetic case, wallet, or both. And get faster wireless charging.
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <img src="{{ asset('images/iphone.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="banner-2">
        <div class="row">
            <div class="col bg-red">
                <div class="wrapper-color">
                    <div class="title-1 text-white">Never-Ending Summer</div>
                    <div class="title-3 text-white">Throwback Shirts & all-day dressed</div>
                    <a href="{{ route('products') }}">
                        <div class="title-5 text-white">Explore all category</div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <img src="{{ asset('images/rectangle-1.png') }}">
                </div>
            </div>
            <div class="col bg-green">
                <div class="wrapper-color">
                    <div class="title-1 text-white">The most famous sport brands</div>
                    <div class="title-3 text-white">Get in gym essentials</div>
                    <a href="{{ route('products') }}">
                        <div class="title-5 text-white">Explore all category</div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <img src="{{ asset('images/rectangle-2.png') }}">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection