@extends('layouts.app')

@section('content')

<main class="about-page">
    <section class="about-hero">
        <div class="wrapper w-100 text-center flex flex-column align-items-center gap-20">
            <div class="title-1">
                About Luminae
            </div>
            <p class="text-grey">
                Welcome to Luminae — a modern online shop created for those
                who love fashion, comfort and timeless style.
            </p>
        </div>
    </section>
    <section class="about-content">
        <div class="row align-items-center gap-40">
            <div class="col">
                <div class="wrapper text-center">
                    <img src="{{ asset('images/logo.png') }}"
                        alt="Luminae"
                        style="max-width: 220px;">
                </div>
            </div>
            <div class="col">
                <div class="wrapper">
                    <div class="title-3">Our Story</div>
                    <p class="text-grey">
                        Luminae was created with a simple idea: shopping should
                        be easy, inspiring and enjoyable.
                    </p>
                    <p class="text-grey">
                        We bring together carefully selected fashion pieces
                        and everyday essentials so you can find something
                        that fits your personal style.
                    </p>
                    <p class="text-grey">
                        From casual outfits to statement pieces, Luminae is
                        here to help you discover something you love.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="about-values">
        <div class="wrapper w-100 text-center">
            <div class="title-3">Why Luminae?</div>
            <div class="row gap-20 justify-content-center">
                <div class="col">
                    <div class="about-box">
                        <div class="title-5">Quality</div>
                        <p class="text-grey">
                            We focus on products that combine style and quality.
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="about-box">
                        <div class="title-5">Style</div>
                        <p class="text-grey">Discover modern pieces designed for every occasion.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="about-box">
                        <div class="title-5">Simple Shopping</div>
                        <p class="text-grey">
                            A clean and easy shopping experience from start to finish.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-bottom text-center w-100 flex justify-content-center align-items-center">
        <div class="wrapper text-center flex flex-column align-items-center gap-20">
            <div class="title-4">Find Your Style With Luminae</div>
            <p class="text-grey text-center ">
                Explore our collection and discover pieces made to become
                part of your everyday style.
            </p>
            <a href="{{ route('products') }}" class="btn-1">SHOP NOW</a>
        </div>
    </section>
</main>

@endsection