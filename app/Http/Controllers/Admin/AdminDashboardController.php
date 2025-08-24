<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use App\Services\WhatsAppContactService;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    protected $dashboardService;
    protected WhatsAppContactService $whatsappService;

    public function __construct(DashboardService $dashboardService, WhatsAppContactService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();
        $revenueAndSalesChart = $this->dashboardService->getRevenueAndSalesData();
        $totalSalesChart = $this->dashboardService->getTotalSalesData();

        return view('admin.dashboard', compact('stats', 'revenueAndSalesChart', 'totalSalesChart'));
    }
    public function whatsaapView()
    {
        $sessionId = Auth::user()->first_name;

        // Check if session exists
        if ($this->whatsappService->sessionExists($sessionId)) {
            // Session already exists → no need to call API
            return view('admin.whatsappQrCode', [
                'qrAlreadyExists' => true,
                'sessionId' => $sessionId,
            ]);
        }
        return view('admin.whatsappQrCode', [
            'qrAlreadyExists' => false,
            'sessionId' => $sessionId,
        ]);

        // return view('admin.whatsappQrCode', compact('stats', 'revenueAndSalesChart', 'totalSalesChart'));
    }
}
