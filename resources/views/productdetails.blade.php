@extends('layouts.app')

@section('content')

<main>
    <section class="bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col w-30">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <div class="title-5 w-700">Categories</div>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <i class="fa-regular fa-user"></i>
                    <div class="title-6">Sign in</div>
                    <i class="fa-regular fa-heart"></i>
                    <a href="{{ route('favorites') }}">
                        <div class="title-6">Favorites</div>
                    </a>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <div class="title-6">Card</div>
                    <span class="cart">3</span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col w-100">
                <div class="wrapper">
                    <div class="title-6"> Homepage<i class="fa-solid fa-chevron-right"></i>
                        Women
                        <i class="fa-solid fa-chevron-right"></i>
                        {{ $product->title }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <i class="fa-solid fa-table-cells-large"></i>
                    <div class="w-700">All Categories</div>
                    <div class="title-6 W-700">BRAND</div>
                    <input type="search" placeholder="Search">
                    <div class="title-6 W-700">MODEL</div>
                    <div class="title-6 text-grey">Short 60</div>
                    <div class="title-6 text-grey">Mid-length 10</div>
                    <div class="title-6 text-grey">Sweather 56</div>
                    <div class="title-6 text-grey">Party Dresses 80</div>
                    <div class="title-6 text-grey">Regular Fit 100</div>
                    <div class="title-6 W-700">STYLE</div>
                    <div class="title-6">
                        <input type="checkbox"> Casual
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Business casual
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Bohemian
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Minimalist
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Uniqlo
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Zara
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Gucci
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Mango
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Ralph Lauren
                    </div>
                    <div class="title-6">
                        <input type="checkbox"> Calvin Klein
                    </div>
                    <div class="title-6 W-700">COLOR</div>
                    <div class="title-10 font-2 p-top">
                        Colors
                    </div>
                    <div class="flex colors gap-5">
                        <div class="color" style="background-color: #FF2E00;"></div>
                        <div class="color" style="background-color: #F7DDD0;"></div>
                        <div class="color" style="background-color: #66A5FF;"></div>
                        <div class="color" style="background-color: #FF9D41;"></div>
                        <div class="color" style="background-color: #FFD36C;"></div>
                        <div class="color" style="background-color: #4BCB88;"></div>
                    </div>
                </div>
                <div class="flex flex-column gap-5">
                    <div class="title-10 font-2">Size</div>
                    <div class="sizes flex gap-10">
                        <label>XS</label>
                        <label>S</label>
                        <label>M</label>
                        <label>L</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <div class="product-details">
                        <div class="product-details-image">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="product-details-info">
                            <h1 class="title-2 w-700">
                                {{ $product->title }}
                            </h1>
                            <p class="text-grey title-6">
                                {{ $product->description }}
                            </p>
                            <div class="price text-red title-2 w-700">
                                ${{ $product->price }}
                            </div>
                            <div class="flex gap-10">
                                <button class="btn-2">Add to Cart</button>
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection