<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\MatchedUser;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardService
{
    public function getDashboardStats()
    {
        // Get the total number of users with role_id = 2
        $totalUsers = User::where('role_id', 2)->count();

        // Get the total number of matches using MatchedUser model
        $totalMatches = MatchedUser::count();

        // Get the number of users last month
        $lastMonthUsers = User::where('role_id', 2)
            ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
            ->count();

        // Get the number of users this month
        $thisMonthUsers = User::where('role_id', 2)
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();

        // Get the number of matches since last month
        $matchesSinceLastMonth = MatchedUser::where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())->count();

        // Calculate growth percentage for this month
        $growthPercentage = $lastMonthUsers > 0 ? (($thisMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100 : 0;

        // Get total revenue from all subscriptions
        $totalRevenue = Subscription::join('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')
            ->sum('subscription_packages.price');

        // Get this month's revenue
        $thisMonthRevenue = Subscription::join('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('subscription_packages.price');

        return [
            'total_users' => $totalUsers,
            'total_matches' => $totalMatches,
            'user_growth_percentage' => round($growthPercentage, 2),
            'users_since_last_month' => $thisMonthUsers,
            'matches_since_last_month' => $matchesSinceLastMonth,
            'total_revenue' => $totalRevenue,
            'this_month_revenue' => $thisMonthRevenue,
        ];
    }

    /**
     * Get revenue and sales data for the last 12 months.
     */
    public function getRevenueAndSalesData()
    {
        // Define the last 12 months range
        $months = collect(range(0, 11))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse();

        // Fetch Revenue Data
        $revenueData = Subscription::join('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')
            ->selectRaw('DATE_FORMAT(subscriptions.start_date, "%Y-%m") as month, SUM(subscription_packages.price) as total_revenue')
            ->whereBetween('subscriptions.start_date', [Carbon::now()->subYear(), Carbon::now()])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total_revenue', 'month');

        // Fetch Sales Data (Total Subscription Purchases Per Month)
        $salesData = Subscription::selectRaw('DATE_FORMAT(start_date, "%Y-%m") as month, COUNT(id) as total_sales')
            ->whereBetween('start_date', [Carbon::now()->subYear(), Carbon::now()])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total_sales', 'month');

        // Ensure all months are included
        $formattedRevenueData = $months->mapWithKeys(fn ($month) => [$month => $revenueData[$month] ?? 0]);
        $formattedSalesData = $months->mapWithKeys(fn ($month) => [$month => $salesData[$month] ?? 0]);

        // Get total revenue and current month revenue
        $totalRevenue = Subscription::join('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')->sum('subscription_packages.price');

        $currentMonthRevenue = Subscription::join('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('subscription_packages.price');

        return [
            'months' => $months->values(),
            'revenue' => $formattedRevenueData->values(),
            'sales' => $formattedSalesData->values(),
            'total_revenue' => $totalRevenue,
            'current_month_revenue' => $currentMonthRevenue,
        ];
    }

    /**
     * Get total sales and city-wise sales data.
     */
    public function getTotalSalesData()
    {
        // Total Users with role_id = 2
        $totalUsers = User::where('role_id', 2)->count();
    
        // Total Sales (Total subscriptions where users have role_id = 2)
        $totalSales = Subscription::
            count();
    
        // Sales by city (for users with role_id = 2)
        $salesByCity = Subscription::join('users', 'subscriptions.user_id', '=', 'users.id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.id')
            ->join('cities', 'user_profiles.city_id', '=', 'cities.id')
            ->where('users.role_id', 2)
            ->select('cities.name_en as city', DB::raw('COUNT(subscriptions.id) as total_sales'))
            ->groupBy('cities.name_en')
            ->orderBy('total_sales', 'desc')
            ->get();
    
        // Preparing data for the chart
        $cityNames = $salesByCity->pluck('city');
        $citySales = $salesByCity->pluck('total_sales');
    
        // Correct Sales Percentage Calculation
        $salesPercentage = $totalUsers > 0 ? round(($totalSales / $totalUsers) * 100) : 0;
    
        return [
            'total_sales' => $totalSales,
            'city_names' => $cityNames,
            'city_sales' => $citySales,
            'sales_percentage' => $salesPercentage, // Used for radial chart
        ];
    }

}