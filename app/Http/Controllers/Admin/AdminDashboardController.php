<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class AdminDashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();
        $revenueAndSalesChart = $this->dashboardService->getRevenueAndSalesData();
        $totalSalesChart = $this->dashboardService->getTotalSalesData();

        return view('admin.dashboard', compact('stats', 'revenueAndSalesChart','totalSalesChart'));
    }
}