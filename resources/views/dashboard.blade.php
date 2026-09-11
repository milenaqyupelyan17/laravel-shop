@extends('layouts.app')
@section('content')
<main>
    <section class="banner bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-user"></i>
                    <div class="title-5 w-700">My Account</div>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <a href="{{ route('home') }}" class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-house"></i>
                        <div class="title-6">Home</div>
                    </a>
                    <a href="{{ route('card') }}" class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <div class="title-6">Cart</div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex gap-5 align-items-center dashboard-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="title-6">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="back_to_website">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-end align-items-center gap-5">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <a href="{{ route('home') }}">
                        <div class="text-grey">Back to the website</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="dashboard">
        <div class="dashboard-wrapper">
            <div class="title-5 w-700">
                Welcome, {{ auth()->user()->name }}
            </div>
            <p class="dashboard-subtitle">
                Manage your account and personal information.
            </p>
            <div class="dashboard-card">
                <div class="dashboard-card-title">
                    <i class="fa-regular fa-user"></i>
                    <span class="title-6 w-700">Personal information</span>
                </div>
                <div class="dashboard-info">
                    <div>
                        <span class="info-label">Name</span>
                        <span class="info-value">
                            {{ auth()->user()->name }}
                        </span>
                    </div>
                    <div>
                        <span class="info-label">Email</span>
                        <span class="info-value">
                            {{ auth()->user()->email }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('home') }}" class="dashboard-action">
                    <i class="fa-solid fa-house"></i>
                    <span>Continue shopping</span>
                </a>
                <a href="{{ route('card') }}" class="dashboard-action">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>My cart</span>
                </a>
            </div>
        </div>
    </section>
</main>

@endsection