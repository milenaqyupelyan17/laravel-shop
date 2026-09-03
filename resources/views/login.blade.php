@extends('layouts.app')

@section('content')
<main>
    <section class="banner bg-black w-100">
        <div class=" row justify-content-between align-items-center">
            <div class="col w-30">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <div class="title-5 w-700">Categories</div>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <div class="title-6">Sign in</div>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-heart"></i>
                        <div class="title-6">Favorites</div>
                    </div>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <div class="title-6">Card</div>
                        <span class="cart title-7">3</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="back_to_website">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-end align-items-center gap-5">
                    <a href="#"><i class="fa-solid fa-arrow-left"></i></a>
                    <a href="{{ route('home') }}">
                        <div class="text-grey">Back to the website</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="auth flex align-items-start">
        <section id="sign_in">
            <div class="title-5 w-700">Sign in</div>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="title-6">Email<span class="text-red">*</span></div>
                <input type="email" name="email" placeholder="Email address" required>
                <div class="title-6">Password<span class="text-red">*</span></div>
                <input type="password" name="password" placeholder="Password" required>
                <div class="sign-options text-beige">
                    <div class="flex align-items-center">
                        <input type="checkbox" name="remember"><span class="title-7">Remember for 30 days</span>
                    </div>
                    <div class="title-7 forgot-password">Forgot password</div>
                </div>
                <button type="submit" class="btn-3">SIGN IN</button>
            </form>
        </section>
        <section id="sign_up">
            <div class="title-5 w-700">Sign up</div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="title-6">Name<span class="text-red">*</span></div>
                <input type="text" name="name" placeholder="Full name" required>
                <div class="title-6">Email<span class="text-red">*</span></div>
                <input type="email" name="email" placeholder="Email address" required>
                <div class="title-6">Password<span class="text-red">*</span></div>
                <input type="password" name="password" placeholder="Password" required>
                <div class="terms">
                    <input type="checkbox" name="terms" required>
                    <div class="title-7 text-beige">
                        Terms and conditions agreement should start with an introduction
                        that lets users know they're reading a terms and conditions agreement
                    </div>
                </div>
                <button type="submit" class="btn-3">SIGN UP</button>
            </form>
        </section>
    </div>
</main>
@endsection