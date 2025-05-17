<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\UserMatch;
use App\Models\Subscription;
use App\Models\SubscriptionContact;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardStats()
    {
        // Get the total number of users with role_id = 2
        $totalUsers = User::where('role_id', 2)->count();

        // Get the total number of matches using UserMatch model
        $totalMatches = UserMatch::count();

        // Get the number of users last month
        $lastMonthUsers = User::where('role_id', 2)
            ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
            ->count();

        // Get the number of users this month
        $thisMonthUsers = User::where('role_id', 2)
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();

        // Get the number of matches since last month
        $matchesSinceLastMonth = UserMatch::where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())->count();

        // Calculate growth percentage for this month
        $growthPercentage = $lastMonthUsers > 0 ? (($thisMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100 : 0;

        // Get total revenue from all payment transactions (using transaction_status instead of status)
        $totalRevenue = PaymentTransaction::where('transaction_status', 'success')
            ->sum('amount');

        // Get this month's revenue
        $thisMonthRevenue = PaymentTransaction::where('transaction_status', 'success')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('amount');

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

        // Fetch Revenue Data (using transaction_status instead of status)
        $revenueData = PaymentTransaction::where('transaction_status', 'success')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total_revenue')
            ->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total_revenue', 'month');

        // Fetch Sales Data (using transaction_status instead of status)
        $salesData = PaymentTransaction::where('transaction_status', 'success')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(id) as total_sales')
            ->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total_sales', 'month');

        // Ensure all months are included
        $formattedRevenueData = $months->mapWithKeys(fn ($month) => [$month => $revenueData[$month] ?? 0]);
        $formattedSalesData = $months->mapWithKeys(fn ($month) => [$month => $salesData[$month] ?? 0]);

        // Get total revenue and current month revenue (using transaction_status instead of status)
        $totalRevenue = PaymentTransaction::where('transaction_status', 'success')->sum('amount');

        $currentMonthRevenue = PaymentTransaction::where('transaction_status', 'success')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('amount');

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
    
        // Total Sales (using transaction_status instead of status)
        $totalSales = PaymentTransaction::where('transaction_status', 'success')->count();
    
        // Sales by city (using transaction_status instead of status)
        $salesByCity = PaymentTransaction::join('subscriptions', 'payment_transactions.subscription_id', '=', 'subscriptions.id')
            ->join('users', 'subscriptions.user_id', '=', 'users.id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.id')
            ->join('cities', 'user_profiles.city_id', '=', 'cities.id')
            ->where('users.role_id', 2)
            ->where('payment_transactions.transaction_status', 'success')
            ->select('cities.name_en as city', DB::raw('COUNT(payment_transactions.id) as total_sales'))
            ->groupBy('cities.name_en')
            ->orderBy('total_sales', 'desc')
            ->get();
    
        // Preparing data for the chart
        $cityNames = $salesByCity->pluck('city');
        $citySales = $salesByCity->pluck('total_sales');
    
        // Calculate Sales Percentage based on total contacts purchased vs total possible contacts
        $salesPercentage = $totalUsers > 0 ? round(($totalSales / $totalUsers) * 100) : 0;
        
        // Get contact usage percentage
        $totalContacts = SubscriptionContact::count();
        $accessedContacts = SubscriptionContact::whereNotNull('accessed_at')->count();
        $contactUsagePercentage = $totalContacts > 0 ? round(($accessedContacts / $totalContacts) * 100) : 0;
    
        return [
            'total_sales' => $totalSales,
            'city_names' => $cityNames,
            'city_sales' => $citySales,
            'sales_percentage' => $salesPercentage, // Used for radial chart
            'contact_usage_percentage' => $contactUsagePercentage, // Contact usage metric
        ];
    }
}