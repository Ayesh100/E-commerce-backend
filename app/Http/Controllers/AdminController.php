<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfThisWeek = $now->copy()->startOfWeek();
        $startOfLastWeek = $now->copy()->subWeek()->startOfWeek();
        $endOfLastWeek = $now->copy()->subWeek()->endOfWeek();

        // Orders this week
        $ordersThisWeek = DB::table('orders')
            ->where('created_at', '>=', $startOfThisWeek)
            ->count();

        // Orders last week
        $ordersLastWeek = DB::table('orders')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $totalOrders = DB::table('orders')->count();

        // Revenue this week
        $revenueThisWeek = DB::table('orders')
        ->where('status', 'completed')
            ->where('created_at', '>=', $startOfThisWeek)
            ->sum('total_price');

        // Revenue last week
        $revenueLastWeek = DB::table('orders')
         ->where('status', 'completed')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum('total_price');

        $totalRevenue = DB::table('orders')->where('status', 'completed')->sum('total_price');

        // Calculate percentage changes
        $orderGrowth = $ordersLastWeek > 0 ? (($ordersThisWeek - $ordersLastWeek) / $ordersLastWeek) * 100 : 0;
        $revenueGrowth = $revenueLastWeek > 0 ? (($revenueThisWeek - $revenueLastWeek) / $revenueLastWeek) * 100 : 0;

        $startOfThisWeek = Carbon::now()->startOfWeek(); // Monday
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // New customers this week
        $newCustomersThisWeek = DB::table('customers')
            ->where('created_at', '>=', $startOfThisWeek)
            ->count();

        // New customers last week
        $newCustomersLastWeek = DB::table('customers')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        // Percentage change
        if ($newCustomersLastWeek > 0) {
            $customerGrowth = (($newCustomersThisWeek - $newCustomersLastWeek) / $newCustomersLastWeek) * 100;
        } else {
            $customerGrowth = 0;
        }

        $totalCustomers = DB::table('customers')->count();

        $customersThisWeek = DB::table('customers')
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        $customersLastWeek = DB::table('customers')
            ->whereBetween('created_at', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])
            ->count();

        if ($customersLastWeek > 0) {
            $customerTotalGrowth = (($customersThisWeek - $customersLastWeek) / $customersLastWeek) * 100;
        } else {
            $customerTotalGrowth = 0;
        }

        $startDate = Carbon::today()->subDays(6); // 7-day window (including today)
        $endDate   = Carbon::today();

        // Query the orders grouped by date
        $ordersByDate = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as order_date'), DB::raw('COUNT(*) as orders_count'))
            ->whereBetween('created_at', [$startDate->toDateString(), $endDate->endOfDay()])
            ->groupBy('order_date')
            ->orderBy('order_date')
            ->get();

        // Prepare an array for the 7 days with default count = 0
        $days = [];
        $ordersCount = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $days[] = $date->format('M d'); // e.g. "Mar 15"

            // Find the count from the query results (if any)
            $orderForDay = $ordersByDate->first(function ($item) use ($formattedDate) {
                return $item->order_date === $formattedDate;
            });
            $ordersCount[] = $orderForDay ? (int) $orderForDay->orders_count : 0;
        }

        // Chart data array for Chart.js
        $ordersChartData = [
            'labels' => $days,
            'datasets' => [
                [
                    'label' => 'Orders Received',
                    'data' => $ordersCount,
                    // You can define the colors here or later in JavaScript
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ]
            ]
        ];

        $productSales = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.product_name', DB::raw('COUNT(order_items.id) as total_sales'))
            ->groupBy('products.product_name')
            ->orderByDesc('total_sales')
            ->limit(4)
            ->get();

        $recentOrders = \App\Models\Order::with('orderItems.product')
            ->latest()
            ->limit(5)
            ->get();


        $revenueByDate = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total_price) as revenue'))
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('order_date')
            ->orderBy('order_date')
            ->get();

        $revenueDays = [];
        $revenueAmounts = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $revenueDays[] = $date->format('M d'); // e.g., "Mar 15"

            // Find the revenue for this date if available; otherwise, default to 0
            $revenueForDay = $revenueByDate->first(function ($item) use ($formattedDate) {
                return $item->order_date === $formattedDate;
            });
            $revenueAmounts[] = $revenueForDay ? (float) $revenueForDay->revenue : 0;
        }

        // Build the Chart.js data array for revenue
        $revenueChartData = [
            'labels' => $revenueDays,
            'datasets' => [
                [
                    'label' => 'Weekly Revenue',
                    'data' => $revenueAmounts,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.5)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 1,
                ]
            ]
        ];

        $completedCount = DB::table('orders')->where('status', 'completed')->count();
        $pendingCount = DB::table('orders')->where('status', 'pending')->count();
        $processingCount = DB::table('orders')->where('status', 'processing')->count();

        // Prepare chart data for the doughnut chart
        $orderSummaryChartData = [
            'labels' => ['Completed', 'Pending', 'Processing'],
            'datasets' => [
                [
                    'data' => [$completedCount, $pendingCount, $processingCount],
                    'backgroundColor' => [
                        'cyan',   // For Completed (e.g., quepal)
                        'orange',    // For Pending (e.g., ibiza)
                        'blue',    // For Processing (e.g., deepblue)
                    ],
                    'borderColor' => [
                        'rgba(20, 171, 239, 1)',
                        'gold',
                        'skyblue',
                    ],
                    'borderWidth' => 1,
                ]
            ]
        ];



        return view('home', compact('totalOrders', 'orderGrowth', 'totalRevenue', 'revenueGrowth', 'newCustomersThisWeek', 'customerGrowth', 'totalCustomers', 'customerTotalGrowth', 'ordersChartData', 'productSales', 'recentOrders','revenueChartData','revenueThisWeek','completedCount','pendingCount','processingCount','orderSummaryChartData'));
    }
}
