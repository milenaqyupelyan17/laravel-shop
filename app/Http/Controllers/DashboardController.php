<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->get();

        $ordersCount = $orders->count();

        $totalSpent = $orders->sum(function ($order) {
            return (float) ($order->total_price ?? 0);
        });

        $recentOrders = $orders->take(5);

        $chartLabels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        $ordersChartData = [];

        $spendingChartData = [];

        for ($month = 1; $month <= 12; $month++) {

            $monthlyOrders = $orders->filter(function ($order) use ($month) {
                return $order->created_at
                    && $order->created_at->month == $month;
            });

            $ordersChartData[] = $monthlyOrders->count();

            $spendingChartData[] = round(
                $monthlyOrders->sum(function ($order) {
                    return (float) ($order->total_price ?? 0);
                }),
                2
            );
        }

        return view('dashboard', compact(
            'ordersCount',
            'totalSpent',
            'recentOrders',
            'chartLabels',
            'ordersChartData',
            'spendingChartData'
        ));
    }
}
