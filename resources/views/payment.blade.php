@extends('layouts.app')

@section('content')
<main>
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
                    <div class id="card-header-count" class="title-6 w-700 text-grey">CARD(0)></div>
                    <div class="title-6 w-700">SHIPPING & PAYMENT</div>
                    <div class="title-6 text-grey w-700">PRODUCT CONFIRMATION</div>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-between align-items-start w-100 gap-20">
        <section id="information" class="w-70">
            <div class="wrapper">
                <div class="br">
                    <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
                        @csrf

                        <div class="flex flex-column gap-20">
                            <div class="title-4 w-700">Customer Information</div>
                            <div class="title-6 w-700">Contact Information</div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">E-mail</div>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Email">
                            </div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">Name</div>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Full name" style="padding: 12px 15px;">
                            </div>
                            <div class="title-6 w-700"> Shipping Address
                            </div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">Country</div>
                                <input type="text" name="country" placeholder="Australia" style="padding: 12px 15px;">
                            </div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">State / Region</div>
                                <input type="text" name="state" placeholder="Melbourne" style="padding: 12px 15px;">
                            </div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">Address</div>
                                <input type="text" name="address" placeholder="10 Beach Street, Melbourne, 2281" style="padding: 12px 15px;">
                            </div>
                            <div class="flex flex-column gap-5">
                                <div class="title-6">Phone Number</div>
                                <input type="text" name="phone" placeholder="(+374) 99 000 000" style="padding: 12px 15px;">
                            </div>
                            <button type="submit" form="payment-form" class="btn-1">
                                Continue to Payment
                            </button>
                        </div>
                    </form>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            const cart = JSON.parse(
                localStorage.getItem(cartKey)
            ) || [];
            if (cart.length === 0) {
                event.preventDefault();
                alert('Your cart is empty. Please add a product first.');
                window.location.href = "{{ route('card') }}";
                return;
            }
            const cartInput = document.createElement('input');
            cartInput.type = 'hidden';
            cartInput.name = 'cart';
            cartInput.value = JSON.stringify(cart);
            form.appendChild(cartInput);
        });
    });
</script>
@endsection