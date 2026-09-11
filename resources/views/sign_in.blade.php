@extends('layouts.app')
@section('content')

<main>
    <div class="auth flex align-items-start">
        <section id="sign_in">
            <div class="title-5 w-700">Welcome back</div>
            <p class="sign-subtitle">Sign in to your account</p>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="title-6"> Email<span class="text-red">*</span></div>
                <input type="email" name="email" placeholder="Email address" required>
                @error('email')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="title-6">Password<span class="text-red">*</span>
                </div>
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                <p class="title-7 text-red">{{ $message }}</p>
                @enderror
                <div class="sign-options flex align-items-center justify-content-between">
                    <label class="remember flex align-items-center">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>
                <button type="submit" class="btn-3">SIGN IN</button>
            </form>
            <div class="signup-link">Don't have an account?<a href="{{ route('register') }}">Sign up</a></div>
        </section>
    </div>
</main>

@endsection