<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\UserPaymentsDataTable;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionReceiptMail;

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
            'email' => 'required|exists:users,email',
            'package_id' => 'required|exists:subscription_packages,id',
            'payment_id' => 'required|exists:user_payments,id',
        ]);

        $email = $request->email;
        $packageId = $request->package_id;
        $paymentId = $request->payment_id;
        $userId = User::where('email', $email)->value('id');
        $package = SubscriptionPackage::findOrFail($packageId);

        // Check existing subscription
        $existingSubscription = Subscription::where('user_id', $userId)
            ->where('end_date', '>', now())
            ->first();

        $startDate = now();
        if ($existingSubscription) {
            $endDate = Carbon::parse($existingSubscription->end_date)
                ->addDays($package->duration);

            $existingSubscription->update([
                'package_id' => $package->id,
                'end_date' => $endDate,
                'contacts_remaining' => $existingSubscription->contacts_remaining + $package->contact_limit,
                'status' => 'active',
            ]);

            $subscription = $existingSubscription;
        } else {
            $endDate = $startDate->copy()->addDays($package->duration);

            $subscription = Subscription::create([
                'user_id' => $userId,
                'package_id' => $package->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'contacts_remaining' => $package->contact_limit,
                'status' => 'active',
            ]);
        }

        // ✅ Update only the pressed record
        // UserPayment::where('id', $paymentId)->update([
        //     'status' => 'paid',
        //     'amount' => $package->price ?? 0,
        //     'date' => now(),
        // ]);
        $subscription->load('user', 'package');
        Mail::to($subscription->user->email)->send(new SubscriptionReceiptMail($subscription));

        return response()->json([
            'message' => 'User subscribed successfully',
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $subscription->end_date->toDateTimeString(),
        ]);
    }
}
