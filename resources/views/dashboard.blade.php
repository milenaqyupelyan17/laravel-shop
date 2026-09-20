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
                        <a href="{{ route('dashboard') }}">Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-header">
            <div class="title-5 w-700">My Account</div>
            <button type="button" class="sidebar-close" id="sidebarClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('products') }}" class="sidebar-link">
                <i class="fa-solid fa-shop"></i>
                <span>Shop</span>
            </a>
            <a href="{{ route('card') }}" class="sidebar-link">
                <i class="fa-solid fa-bag-shopping"></i>
                <span>Cart</span>
            </a>
        </div>
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="row w-100 align-items-start">
        <section id="account" class="w-20" style="min-height: 50vh;">
            <div class="wrapper bg-grey" style="min-height: 50vh;">
                <div class="flex flex-column gap-20" style="padding: 30px;">
                    <div class="title-5 w-700">
                        Dashboard
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
                        <button type="submit" class="title-6 menu-button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section id="dashboard" class="w-80">
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
            </div>
        </section>
    </div>
</main>
<script>
    const sidebar = document.getElementById('dashboardSidebar');
    const sidebarOpen = document.getElementById('sidebarOpen');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    sidebarOpen.addEventListener('click', function() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');

    });
    sidebarClose.addEventListener('click', function() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');

    });
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });
</script>
@endsection