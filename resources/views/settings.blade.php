@extends('layouts.app')

@section('content')

<main>
    <section>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="title-6">
                        <a href="{{ route('home') }}">
                            Homepage
                        </a>
                        <i class="fa-solid fa-chevron-right"></i>
                        Settings
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
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-regular fa-user"></i>
                            Account
                        </button>
                    </form>
                    <form action="{{ url('settings') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->is('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </button>
                    </form>
                    <form action="{{ route('carts') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('carts') ? 'active' : '' }}">
                            <i class="fa-regular fa-credit-card"></i>
                            My Cards
                        </button>
                    </form>
                    <form action="{{ route('favorites') }}" method="GET">
                        <button type="submit"
                            class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <i class="fa-regular fa-heart"></i>
                            Favorites
                        </button>
                    </form>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="title-6 menu-button {{ request()->routeIs('favorites') ? 'active' : '' }}">
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
                     <div class="title-3 w-700">Settings</div>
                <p class="text-grey title-6">
                    Manage your account information and password.
                </p>
                 </div>
               <div class=" flex" style="padding-top:40px;">
                 <div class="flex flex-column gap-20">
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
                </div>
                <div class="wrapper br w-50 flex">
                   <div class="flex flex-column gap-20 ">
                     <div class="flex flex-column gap-20">
                        <div class="title-5 w-700">Personal Information</div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Full Name</div>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" form="settings-form" placeholder="Full name" required style="padding: 15px;">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Email</div>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" form="settings-form" placeholder="Email address" required>
                        </div>
                    </div>
                   </div>
                </div>
                <div class="wrapper br w-33">
                    <div class="flex flex-column gap-20">
                        <div class="title-5 w-700">Change Password</div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Current Password</div>
                            <input type="password" name="current_password" form="settings-form" placeholder="Current password" style="padding: 15px;">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">New Password</div>
                            <input type="password" name="password" form="settings-form" placeholder="New password" style="padding: 15px;">
                        </div>
                        <div class="flex flex-column gap-5">
                            <div class="title-6">Confirm New Password</div>
                            <input type="password" name="password_confirmation" form="settings-form"
                                placeholder="Confirm new password" style="padding: 15px;">
                        </div>
                    </div>
                    <form id="settings-form" style="padding-top: 20px;" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="btn-1 justify-content-end text-end">
                        Save Changes
                    </button>
                </form>
                </div>
               </div>
            </div>
        </section>
    </div>
</main>

@endsection