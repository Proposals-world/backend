<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\UserPaymentsDataTable;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;

class UserPaymentController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(UserPaymentsDataTable $dataTable)
    {
        return $dataTable->render('admin.userPayments.index');
    }

    public function subscribeForUser(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'package_id' => 'required|exists:subscription_packages,id',
        ]);

        $subscription = $this->subscriptionService->createOrRenew(
            $request->user_id,
            $request->package_id
        );
        // Update the related payment status to 'paid'
        UserPayment::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
            ],
            [
                'status' => 'active',
                'amount' => $subscription->package->price ?? 0,
                'date' => now(),
            ]
        );

        return response()->json([
            'message' => 'User subscribed successfully',
            // 'subscription' => $subscription,
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $subscription->end_date->toDateTimeString(),
        ]);
    }
}
