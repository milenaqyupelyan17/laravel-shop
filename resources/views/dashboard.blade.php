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
                        <a href="{{ route('dashboard') }}">
                            Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-header">
            <div class="title-5 w-700">
                My Account
            </div>
            <button
                type="button"
                class="sidebar-close"
                id="sidebarClose">
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
            <form
                action="{{ route('logout') }}"
                method="POST"
                id="logoutForm">

                @csrf
                <button
                    type="submit"
                    class="title-6 menu-button">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Log Out
                </button>
            </form>
        </div>
    </aside>
    <div
        class="sidebar-overlay"
        id="sidebarOverlay">
    </div>
    <div class="row w-100 align-items-start">
        <section
            id="account"
            class="w-20">
            <div class="wrapper bg-grey">
                <div
                    class="flex flex-column gap-20"
                    style="padding: 30px;">
                    <div class="title-5 w-700">
                        My Account
                    </div>
                    <div class="flex flex-column gap-20">
                        <a
                            href="{{ route('dashboard') }}"
                            class="title-6 menu-button active">

                            <i class="fa-regular fa-user"></i>
                            Account
                        </a>
                        <a
                            href="{{ route('orders') }}"
                            class="title-6 menu-button">
                            <i class="fa-regular fa-credit-card"></i>
                            My Orders
                        </a>
                        <a
                            href="{{ route('carts') }}"
                            class="title-6 menu-button">
                            <i class="fa-solid fa-cart-shopping"></i>
                            My Cards
                        </a>
                        <a
                            href="{{ route('favorites') }}"
                            class="title-6 menu-button">
                            <i class="fa-regular fa-heart"></i>
                            Favorites

                        </a>
                        <a
                            href="{{ route('settings') }}"
                            class="title-6 menu-button">

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
            id="dashboard"
            class="w-80">

            <div class="dashboard-wrapper">
                <div class="title-5 w-700">
                    Welcome, {{ auth()->user()->name }}
                </div>

                <p class="dashboard-subtitle">
                    Manage your account and see your shopping activity.
                </p>

                <div class="dashboard-stats">
                    <div class="dashboard-stat-card">

                        <div class="dashboard-stat-icon">
                            <i class="fa-solid fa-box"></i>
                        </div>

                        <div class="dashboard-stat-content">

                            <span class="dashboard-stat-label">
                                Orders
                            </span>

                            <span class="dashboard-stat-number">
                                {{ $ordersCount ?? 0 }}
                            </span>
                        </div>
                    </div>
                    <div class="dashboard-stat-card">

                        <div class="dashboard-stat-icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="dashboard-stat-content">
                            <span class="dashboard-stat-label">
                                Active Cart
                            </span>
                            <span
                                class="dashboard-stat-number"
                                id="dashboard-cart-count">
                                0
                            </span>
                        </div>
                    </div>
                    <div class="dashboard-stat-card">
                        <div class="dashboard-stat-icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <div class="dashboard-stat-content">
                            <span class="dashboard-stat-label">
                                Favorites
                            </span>
                            <span
                                class="dashboard-stat-number"
                                id="dashboard-favorites-count">
                                0
                            </span>
                        </div>
                    </div>
                    <div class="dashboard-stat-card">
                        <div class="dashboard-stat-icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div class="dashboard-stat-content">
                            <span class="dashboard-stat-label">
                                Total Spent
                            </span>
                            <span class="dashboard-stat-number">
                                ${{ number_format($totalSpent ?? 0, 2) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-analytics">
                    <div class="dashboard-chart-card">
                        <div class="dashboard-chart-header">
                            <div>
                                <div class="title-6 w-700">
                                    Orders Analytics
                                </div>
                                <p>
                                    Your orders during the year
                                </p>
                            </div>
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="dashboard-chart-container">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                    <div class="dashboard-chart-card">
                        <div class="dashboard-chart-header">
                            <div>
                                <div class="title-6 w-700">
                                    Spending Analytics
                                </div>
                                <p>
                                    Your monthly spending
                                </p>
                            </div>
                            <i class="fa-solid fa-chart-column"></i>
                        </div>
                        <div class="dashboard-chart-container">
                            <canvas id="spendingChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="dashboard-table-card">
                    <div class="dashboard-table-header">
                        <div>
                            <div class="title-6 w-700">
                                Recent Orders
                            </div>
                            <p>
                                Your latest purchases
                            </p>
                        </div>
                        <a
                            href="{{ route('orders') }}"
                            class="dashboard-view-all">
                            View All
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="dashboard-table-wrapper">
                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>
                                        Order
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td>
                                        #{{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->total_quantity ?? 0 }}
                                    </td>
                                    <td>
                                        ${{ number_format($order->total_price ?? 0, 2) }}
                                    </td>
                                    <td>
                                        <span class="order-status">
                                            {{ ucfirst($order->status ?? 'Purchased') }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $order->created_at?->format('d M Y') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td
                                        colspan="5"
                                        class="dashboard-empty">
                                        You don't have any orders yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartKey = 'cart_user_{{ auth()->id() }}';
        let cart = [];
        const savedCart = localStorage.getItem(cartKey);
        if (savedCart) {
            try {
                cart = JSON.parse(savedCart);
            } catch (error) {
                cart = [];
            }
        }

        let cartCount = 0;
        if (Array.isArray(cart)) {
            cart.forEach(function(item) {
                cartCount += Number(item.quantity) || 0;
            });

        }

        const cartCountElement = document.getElementById('dashboard-cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = cartCount;
        }

        const favoritesKey = 'favorites_user_{{ auth()->id() }}';

        let favorites = [];
        const savedFavorites =
            localStorage.getItem(favoritesKey);

        if (savedFavorites) {

            try {
                favorites = JSON.parse(savedFavorites);
            } catch (error) {
                favorites = [];
            }

        }

        const favoritesCountElement =
            document.getElementById('dashboard-favorites-count');

        if (favoritesCountElement) {

            if (Array.isArray(favorites)) {
                favoritesCountElement.textContent = favorites.length;
            } else {
                favoritesCountElement.textContent = 0;
            }

        }

        const chartLabels = {
            !!json_encode($chartLabels) !!
        };

        const ordersChartData = {
            !!json_encode($ordersChartData) !!
        };

        const spendingChartData = {
            !!json_encode($spendingChartData) !!
        };

        const ordersCanvas =
            document.getElementById('ordersChart');

        if (ordersCanvas) {

            new Chart(ordersCanvas, {

                type: 'line',

                data: {

                    labels: chartLabels,
                    datasets: [{
                        label: 'Orders',
                        data: ordersChartData,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: false
                    }]

                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {

                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
        const spendingCanvas = document.getElementById('spendingChart');
        if (spendingCanvas) {

            new Chart(spendingCanvas, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Spent',
                        data: spendingChartData,
                        borderWidth: 1
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        const sidebar = document.getElementById('dashboardSidebar');
        const sidebarOpen = document.getElementById('sidebarOpen');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');


        if (
            sidebar &&
            sidebarClose &&
            sidebarOverlay
        ) {
            if (sidebarOpen) {
                sidebarOpen.addEventListener('click', function() {
                    sidebar.classList.add('active');
                    sidebarOverlay.classList.add('active');
                });

            }


            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        }
    });
</script>

@endsection