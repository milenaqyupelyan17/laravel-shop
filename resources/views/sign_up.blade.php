@extends('layouts.app')

@section('content')

<main>

    <div class="row">
        <div class="col">
            <div class="wrapper">
                <div class="title-6 flex gap-5 align-items-center">
                    <a href="{{ route('home') }}">
                        Homepage
                    </a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span>
                        Sign Up
                    </span>
                </div>
                <div class="auth-container">
                    <h1>CREATE ACCOUNT</h1>
                    @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="error-message">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Confirm your password"
                                required>
                        </div>
                        <button type="submit" class="btn-1">
                            SIGN UP
                        </button>
                    </form>
                    <p class="auth-link">
                        Already have an account?
                        <a href="{{ route('login') }}">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection