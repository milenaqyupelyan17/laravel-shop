@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6 flex gap-5 align-items-center">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>
                            Settings
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row gap-20 align-items-start">
        <section id="account" class="w-20" style="min-height: 50vh;">
            <div class="wrapper bg-grey" style="min-height: 50vh;">
                <div class="flex flex-column gap-20" style="padding: 30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <form action="{{ route('dashboard') }}" method="GET">
                        <button
                            type="submit"
                            class="title-6 menu-button
                            {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </button>
                    </form>
                    <form action="{{ route('settings') }}" method="GET">
                        <button
                            type="submit"
                            class="title-6 menu-button
                            {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </button>
                    </form>
                    <form action="{{ route('carts') }}" method="GET">
                        <button
                            type="submit"
                            class="title-6 menu-button
                            {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Cards
                        </button>
                    </form>
                    <form action="{{ route('favorites') }}" method="GET">
                        <button
                            type="submit"
                            class="title-6 menu-button
                            {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </button>
                    </form>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="title-6 menu-button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section id="settings" class="w-80">
            <div class="wrapper">
                <div class="w-100 text-center flex flex-column gap-20">
                    <div class="title-3 w-700">
                        Settings
                    </div>
                    <p class="text-grey title-6">
                        Manage your account information and password.
                    </p>
                </div>
                <div style="padding-top: 30px;">
                    @if(session('success'))
                        <div class="title-6" style="color: green; padding: 15px;text-align: center;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div
                            class="title-6"
                            style="
                                color: red;
                                padding: 15px;
                            ">
                            @foreach($errors->all() as $error)
                                <div>
                                    {{ $error }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <form
                    id="settings-form"
                    action="{{ route('settings.update') }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-20 align-items-start"
                        style="padding-top: 30px;">
                        <div class="wrapper br w-50">
                            <div class="flex flex-column gap-20">
                                <div class="title-5 w-700">
                                    Personal Information
                                </div>
                                <div class="flex flex-column gap-5">
                                    <div class="title-6">
                                        Full Name
                                    </div>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        placeholder="Full name"
                                        required
                                        style="padding: 15px;">
                                </div>
                                <div class="flex flex-column gap-5">
                                    <div class="title-6">
                                        Email
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        placeholder="Email address"
                                        required
                                        style="padding: 15px;">
                                </div>
                            </div>
                        </div>
                        <div class="wrapper br w-50">
                            <div class="flex flex-column gap-20">
                                <div class="title-5 w-700">
                                    Change Password
                                </div>
                                <div class="flex flex-column gap-5">
                                    <div class="title-6">
                                        Current Password
                                    </div>
                                    <input
                                        type="password"
                                        name="current_password"
                                        value="{{ old('current_password') }}"
                                        placeholder="Current password"
                                        style="padding: 15px;">
                                </div>
                                <div class="flex flex-column gap-5">
                                    <div class="title-6">
                                        New Password
                                    </div>
                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="New password"
                                        style="padding: 15px;">
                                </div>
                                <div class="flex flex-column gap-5">
                                    <div class="title-6">
                                        Confirm New Password
                                    </div>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Confirm new password"
                                        style="padding: 15px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-content-end"
                        style="padding-top: 20px;">
                        <button
                            type="submit"
                            class="btn-1">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>

@endsection