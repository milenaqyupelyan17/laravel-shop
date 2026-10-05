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
                        Settings
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-start flex gap-20 settings-page">
        <section
            id="account"
            class="w-20">
            <div class="wrapper bg-grey">
                <div
                    class="flex flex-column gap-20"
                    style="padding:30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <div class="flex flex-column gap-20">
                        <a
                            href="{{ route('dashboard') }}"
                            class="title-6 menu-button {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </a>
                        <a
                            href="{{ route('orders') }}"
                            class="title-6 menu-button {{ request()->routeIs('orders') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Orders
                        </a>
                        <a
                            href="{{ route('carts') }}"
                            class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            My Cards
                        </a>
                        <a
                            href="{{ route('favorites') }}"
                            class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </a>
                        <a
                            href="{{ route('settings') }}"
                            class="title-6 menu-button {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                        <form
                            action="{{ route('logout') }}"
                            method="POST">
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
            </div>
        </section>
        <section
            id="settings-content">
            <div class="settings-container">
                <h1>
                    PERSONAL INFORMATION
                </h1>
                @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>

                @endif
                @if(session('error'))

                <div class="error-message">
                    {{ session('error') }}
                </div>

                @endif
                @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                    <p>
                        {{ $error }}
                    </p>
                    @endforeach
                </div>
                @endif
                <form
                    action="{{ route('settings.update') }}"
                    method="POST">

                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">
                            Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
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
                            value="{{ old('email', auth()->user()->email) }}"
                            required>
                    </div>
                    <hr>
                    <h2>
                        CHANGE PASSWORD
                    </h2>
                    <div class="form-group">
                        <label for="current_password">
                            Current Password
                        </label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            placeholder="Enter current password">
                    </div>
                    <div class="form-group">

                        <label for="password">
                            New Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter new password">
                    </div>
                    <div class="form-group">

                        <label for="password_confirmation">
                            Confirm New Password
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm new password">
                    </div>
                    <button
                        type="submit"
                        class="btn-1">
                        SAVE CHANGES
                    </button>
                </form>
            </div>
        </section>
    </div>
</main>


<style>
    .settings-page {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .settings-page #account {
        width: 20%;
        flex-shrink: 0;
    }

    .settings-page #account .wrapper {
        width: 100%;
    }

    .settings-page #account .bg-grey {
        width: 100%;
    }

    #settings-content {
        width: 80%;
        flex: 1;
    }

    .settings-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 40px;
        background: #f5f5f5;
        box-sizing: border-box;
    }

    .settings-container h1 {
        margin: 0 0 35px;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: 1px;
    }


    .settings-container h2 {
        margin: 35px 0 25px;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .settings-container form {
        width: 100%;
    }


    .settings-container .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 23px;
    }

    .settings-container label {
        font-size: 15px;
        font-weight: 600;
    }

    .settings-container input {
        width: 100%;
        height: 48px;
        padding: 0 15px;
        border: 1px solid #d5d5d5;
        background: #fff;
        font-size: 15px;
        outline: none;
        box-sizing: border-box;
        transition: border 0.2s ease;
    }

    .settings-container input:focus {
        border-color: #222;
    }

    .settings-container input::placeholder {
        color: #999;
    }

    .settings-container hr {
        border: none;

        border-top: 1px solid #ddd;
        margin: 40px 0 0;
    }

    .settings-container .btn-1 {
        margin-top: 10px;
        min-width: 180px;
        height: 48px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .settings-container .success-message {
        margin-bottom: 25px;
        padding: 14px 18px;
        background: #eaf7ee;
        border: 1px solid #b8dfc2;
        color: #28733b;
        font-size: 14px;
    }

    .settings-container .error-message {
        margin-bottom: 25px;
        padding: 14px 18px;
        background: #fff0f0;
        border: 1px solid #e2bcbc;
        color: #b32626;
        font-size: 14px;
    }


    .settings-container .error-message p {
        margin: 4px 0;
    }

    @media (max-width: 800px) {

        .settings-page {
            flex-direction: column;
        }


        .settings-page #account {
            width: 100%;
        }


        #settings-content {
            width: 100%;
        }


        .settings-container {
            max-width: 100%;
            padding: 30px 20px;
        }

    }


    @media (max-width: 500px) {

        .settings-container h1 {
            font-size: 22px;
        }


        .settings-container h2 {
            font-size: 18px;
        }

        .settings-container .btn-1 {
            width: 100%;
        }

    }
</style>

@endsection