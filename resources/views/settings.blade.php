@extends('layouts.app')

@section('content')

<main>
    <section class="bg-black w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <div class="wrapper flex align-items-center gap-5">
                    <i class="fa-solid fa-table-list"></i>
                    <a href="{{ route('categories') }}">
                        <div class="title-5 w-700">Categories</div>
                    </a>
                </div>
            </div>
            <div class="col flex">
                <div class="wrapper flex align-items-center gap-20">
                    <a href="{{ route('dashboard') }}" class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <div class="title-6">Account</div>
                    </a>
                    <a href="{{ route('favorites') }}" class="flex gap-5 align-items-center">
                        <i class="fa-regular fa-heart"></i>
                        <div class="title-6">Favorites</div>
                    </a>
                    <a href="{{ route('card') }}" class="flex gap-5 align-items-center">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <div class="title-6">Card</div>
                        <span id="cart-count" class="cart title-7">0</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <a href="{{ route('dashboard') }}">Account</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        Settings
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row w-100 align-items-start">
        <section id="account" class="w-20">
            <a href="{{ route('home') }}">
                <img class="logoImage" src="{{ asset('images/logo.png') }}" alt="Luminae">
            </a>
            <a href="{{ route('home') }}">
                <div class="title-2 w-700">Luminae</div>
            </a>
            <div class="wrapper bg-grey"
                style="min-height: 100vh;">
                <div class="flex flex-column gap-20">
                    <div class="title-5 w-700">My Account</div>
                    <a href="{{ route('dashboard') }}"
                        class="title-6">
                        <i class="fa-regular fa-user"></i>
                        Account
                    </a>
                    <a href="{{ route('settings') }}"
                        class="title-6">
                        <i class="fa-solid fa-gear"></i>
                        Settings
                    </a>
                    <a href="carts"
                        class="title-6">
                        <i class="fa-regular fa-credit-card"></i>
                        My Cards
                    </a>
                    <a href="{{ route('favorites') }}" class="title-6">
                        <i class="fa-regular fa-heart"></i> Favorites</a>
                    <form action="{{ route('logout') }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="title-6">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section id="settings" class="w-80">
            <div class="wrapper">
                <div class="title-3 w-700">Settings</div>
                <p class="text-grey title-6">
                    Manage your account information and password.
                </p>
                @if(session('success'))
                <div class="title-6"
                    style="padding: 15px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="text-red title-6">
                    @foreach($errors->all() as $error)
                    <div>
                        {{ $error }}
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="wrapper br">
                    <div class="flex flex-column gap-20">
                        <div class="title-5 w-700">Personal Information</div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Full Name</div>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" form="settings-form" placeholder="Full name" required>
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Email</div>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" form="settings-form" placeholder="Email address" required>
                        </div>
                    </div>
                </div>
                <div class="wrapper bg-grey br">
                    <div class="flex flex-column gap-20">
                        <div class="title-5 w-700">Change Password</div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Current Password</div>
                            <input type="password" name="current_password" form="settings-form" placeholder="Current password">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">New Password</div>
                            <input type="password" name="password" form="settings-form" placeholder="New password">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Confirm New Password</div>
                            <input type="password" name="password_confirmation" form="settings-form"
                                placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
                <form id="settings-form" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="btn-1">
                        Save Changes
                    </button>
                </form>
            </div>
        </section>
    </div>
</main>

@endsection