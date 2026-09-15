@extends('layouts.app')

@section('content')

<main>
    <section id="back_to_website">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-end">
                    <a href="{{ route('home') }}" class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-arrow-left"></i>
                        <div class="text-grey">Back to the website</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="auth flex justify-content-center align-items-center">
        <section id="sign_up">
            <div class="title-5 w-700">Sign up</div>
            <p class="sign-subtitle">Create your account</p>
            <form action="{{ route('register') }}" method="POST" class="flex flex-column gap-5">
                @csrf
                <div class="title-6"> Name<span class="text-red">*</span></div>
                <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
                @error('name')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="title-6">Email<span class="text-red">*</span>
                </div>
                <input type="email" name="email" placeholder="Email address" value="{{ old('email') }} " required>
                @error('email')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="title-6">Password<span class="text-red">*</span>
                </div>
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                <p class="title-7 text-red"> {{ $message }}</p>
                @enderror
                <div class="title-6"> Confirm Password<span class="text-red">*</span>
                </div>
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                <button type="submit" class="btn-1 w-100">SIGN UP</button>
            </form>
            <div class="signup-link flex gap-5">Already have an account?<a href="{{ route('login') }}">Sign in</a></div>
        </section>
    </div>
</main>
@endsection