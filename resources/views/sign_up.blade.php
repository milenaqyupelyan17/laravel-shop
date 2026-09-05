@extends('layouts.app')

@section('content')

<main>
    <section class="banner bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col w-30">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <div class="title-5 w-700">Categories</div>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <a href="{{ route('login') }}" class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <div class="title-6">Sign in</div>
                    </a>
                    <div class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-heart"></i>
                        <div class="title-6">Favorites</div>
                    </div>
                    <a href="{{ route('card') }}" class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <div class="title-6">Card</div>
                        <span class="cart title-7">3</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="back_to_website">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-end align-items-center gap-5">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i></a>
                    <a href="{{ route('home') }}">
                        <div class="text-grey">Back to the website</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="auth flex align-items-start">
        <section id="sign_up">
            <div class="title-5 w-700">Sign up</div>
            <p class="sign-subtitle">Create your account</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="title-6">
                    Name<span class="text-red">*</span>
                </div>
                <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}"required>
                @error('name')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="title-6">
                    Email<span class="text-red">*</span>
                </div>
                <input type="email"name="email" placeholder="Email address" value="{{ old('email') }} "required>
                @error('email')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="title-6">
                    Password<span class="text-red">*</span>
                </div>
                <input type="password" name="password"placeholder="Password"required>
                @error('password')
                <p class="title-7 text-red"> {{ $message }}</p>
                @enderror
                <div class="title-6">
                    Confirm Password<span class="text-red">*</span>
                </div>
                <input type="password"  name="password_confirmation" placeholder="Confirm password"required>
                <div class="terms">
                    <input type="checkbox" name="terms" required>
                    <div class="title-7 text-beige">I agree to the terms and conditions.</div>
                </div>
                <button type="submit" class="btn-3">SIGN UP</button>
            </form>
            <div class="signup-link">
                Already have an account?
                <a href="{{ route('login') }}">Sign in</a>
            </div>
        </section>
    </div>
</main>
@endsection