<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Count visits for today
        $todayVisits = Visit::whereDate('visited_at', Carbon::today())->count();

        // Count total products
        $products = Product::count();

        // Define date one week ago
        $oneWeekAgo = Carbon::now()->subWeek();

        // Calculate total order count for the last week
        $orderCount = Order::where('created_at', '>=', $oneWeekAgo)->count();

        // Calculate order count for the previous week
        $previousWeekCount = Order::whereBetween('created_at', [
            Carbon::now()->subWeeks(2),
            $oneWeekAgo,
        ])->count();

        // Calculate percentage change in order count
        $percentageChange = ($previousWeekCount > 0) ? (($orderCount - $previousWeekCount) / $previousWeekCount) * 100 : ($orderCount > 0 ? 100 : 0);

        // Calculate progress bar width (example logic, adjust as needed)
        $progressBarWidth = min($orderCount / 100 * 100, 100);

        // Calculate total order amount for the current month
        $totalAmountMonth = Order::where('payment_status', "to'langan")
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        // Calculate total order amount for the previous month
        $totalAmountPreviousMonth = Order::where('payment_status', "to'langan")
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_amount');

        // Calculate percentage change in total amount
        $percentageChangeExp = ($totalAmountPreviousMonth > 0) ? (($totalAmountMonth - $totalAmountPreviousMonth) / $totalAmountPreviousMonth) * 100 : ($totalAmountMonth > 0 ? 100 : 0);

        return view('admin', compact('todayVisits', 'products', 'totalAmountMonth', 'percentageChangeExp', 'orderCount', 'percentageChange', 'progressBarWidth'));
    }
}
