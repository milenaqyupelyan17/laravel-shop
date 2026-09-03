@extends('layouts.app')

@section('content')
<main>
    <section class="bg-black w-100">
        <div class=" row justify-content-between align-items-center">
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
                    <div class="title-6">Favorites</div>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <div class="title-6">Card</div>
                    <span class="cart">3</span>
                </div>
            </div>
        </div>
    </section>
    <section id="">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6">Homepage <i class="fa-solid fa-chevron-right"></i> Card</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="wrapper flex gap-20">
                    <div class="title-6 w-700 text-grey">CARD(3)</div>
                    <div class="title-6 w-700 text-grey">SHIPPING & PAYMENT </div>
                    <div class="title-6 w-700">PRODUCT CONFIRMATION</div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-grey br w-50">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="w-700">Order Summary</div>
                    <div class="text-grey title-6">Price</div>
                    <div class="text-grey title-6">Discount price</div>
                    <div class="text-grey title-6">Total Price</div>
                    <div class="btn-2">Shop now</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <input type="text" placeholder="210548">
                    <div class="btn-1">Apply code</div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection