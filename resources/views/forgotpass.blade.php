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
                    <i class="fa-solid fa-arrow-left"></i>
                    <div class="text-grey">Back to the login</div>
                </div>
            </div>
        </div>
    </section>
    <section id="">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-4 w-700">Forgot password</div>
                    <div class="text-grey">Enter your email adress to reacquisition to your password.</div>
                    <div class="title-6 w-700">Email*</div>
                    <input type="email" placeholder="Email address">
                    <div class="title-6 w-700">New Password*</div>
                    <input type="email" placeholder="New Password">
                    <div class="btn-3">RESET PASSWORD</div>
                    <div class="title-6 w-700">Don’t have an account?</div>
                    <div class="text-red">Sign Up</div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection