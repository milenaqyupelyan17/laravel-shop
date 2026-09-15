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
    <section id="">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">Homepage</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <a href="{{ route('card') }}">Card</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="wrapper flex gap-20 align-items-center">
                    <a href="{{ route('card') }}" id="card-header-count" class="title-6 w-700 text-grey">CARD(0)</a>
                    <div class="title-6 w-700">SHIPPING & PAYMENT</div>
                    <a href="{{ route('confirmation') }}" class="title-6 text-grey w-700">PRODUCT CONFIRMATION</a>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-between align-items-start w-100 gap-20">
        <section id="information" class="w-70">
            <div class="wrapper">
                <div class="br">
                    <div class="flex flex-column gap-20">
                        <div class="title-4 w-700">Customer Information</div>
                        <div class="title-6 w-700">Contact Information</div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">E-mail</div>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Name</div>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Full name">
                        </div>
                        <div class="title-6 w-700"> Shipping Address
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Country</div>
                            <input type="text" name="country" placeholder="Australia">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">State / Region</div>
                            <input type="text" name="state" placeholder="Melbourne">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Address</div>
                            <input type="text" name="address" placeholder="10 Beach Street, Melbourne, 2281">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Phone Number</div>
                            <input type="text" name="phone" placeholder="(+374) 99 000 000">
                        </div>
                        <a href="{{ route('confirmation') }}" class="btn-1 text-center">
                            Continue to Payment
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="order bg-grey br w-30" style="padding: 20px">
            <div class="wrapper flex flex-column gap-20">
                <div class="w-700 title-5">Order Summary</div>
                <div class="flex justify-content-between">
                    <div class="text-grey title-6">Price</div>
                    <div class="title-6">$0</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-grey title-6">Discount price </div>
                    <div class="title-6">$0</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="w-700 title-6">Total Price</div>
                    <div class="w-700 title-6 text-red">$0</div>
                </div>
                <a href="{{ route('products') }}" class="btn-1 text-center">Shop now</a>
                <div class="flex gap-5">
                    <input type="text" placeholder="210548">
                    <div class="btn-1">Apply code</div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection