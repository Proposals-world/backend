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
use App\Services\FwateerService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;

class UserPaymentController extends Controller
{
    protected $subscriptionService;
    protected $fwateerService;

    public function __construct(SubscriptionService $subscriptionService, FwateerService $fwateerService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->fwateerService = $fwateerService;
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
            // 'payment_id' => 'required|exists:user_payments,id',
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
        UserPayment::where('id', $paymentId)->update([
            'status' => 'paid',
            'amount' => $package->price ?? 0,
            'date' => now(),
        ]);
        $subscription->load('user', 'package');
        // ✅ Retrieve the updated payment
        $payment = UserPayment::find($paymentId);
        // ✅ Create an invoice (fwateer record)
        $fwateer = $this->fwateerService->create([
            'company_name'     => 'Authenticatcity and modernity Company for Information Technology',
            'company_address'  => 'Amman, Jordan',
            'trade_reg_number' => '75739',
            'sales_tax_number' => '40290018',
            'invoice_date'     => now()->toDateString(),
            'user_id'          => $userId,
            'amount'           => $payment->final_amount ?? ($package->price ?? 0),
            'package_id'       => $package->id ?? null, // ✅ new line
            'payment_method'   => $payment->payment_type,
            'reference_number' => $payment->reference_number ?? null,

        ]);
        Mail::to($subscription->user->email)->send(new SubscriptionReceiptMail($subscription, $fwateer));

        return response()->json([
            'message' => 'User subscribed successfully',
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $subscription->end_date->toDateTimeString(),
        ]);
    }
    public function updatePaymentDetails(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'payment_id' => 'required|exists:user_payments,id',
                'final_amount' => 'required|numeric|min:0',
                'reference_number' => 'nullable|string|max:100',
            ]);

            // ✅ Find payment record
            $payment = UserPayment::findOrFail($validated['payment_id']);

            // ✅ Update the fields
            $payment->update([
                'final_amount' => $validated['final_amount'],
                'reference_number' => $validated['reference_number'],
            ]);

            return response()->json([
                'message' => 'Payment details updated successfully.',
                'data' => [
                    'id' => $payment->id,
                    'final_amount' => $payment->final_amount,
                    'reference_number' => $payment->reference_number,
                ],
            ], 200);
        } catch (\Throwable $e) {
            \Log::error('Error updating payment details: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'An error occurred while updating payment details.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // saves cliq payment

    public function storeCliq(Request $request, NotificationService $notificationService)
    {
        try {
            // ✅ Validate incoming data
            $validator = Validator::make($request->all(), [
                'photo_url'  => 'required|image|max:2048',
                'package_id' => [
                    'required',
                    'exists:subscription_packages,id',
                    function ($attribute, $value, $fail) {
                        if (in_array($value, [999, 1000])) {
                            $fail(__('Invalid package selected.'));
                        }
                    },
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // ✅ Try storing the uploaded image
            try {
                $photoPath = $request->file('photo_url')->store('cliq_payments', 'public');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error uploading screenshot: ' . $e->getMessage(),
                ], 500);
            }

            // ✅ Fetch the package
            $package = SubscriptionPackage::find($request->package_id);
            if (!$package) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selected package not found.',
                ], 404);
            }

            // ✅ Create the payment record
            $payment = UserPayment::create([
                'user_id'      => auth()->id(),
                'package_id'   => $package->id,
                'email'        => auth()->user()->email,
                'amount'       => $package->price,
                'date'         => now(),
                'status'       => 'pending',
                'payment_type' => 'cliq',
                'photo_url'    => $photoPath,
            ]);
            // ============================
            // ✅ NOTIFICATIONS START HERE
            // ============================

            // 1) ✅ Notify Admins
            $admins = User::where('role_id', 1)->get(); // <-- replace with your real admin filter

            foreach ($admins as $admin) {
                $notificationService->create($admin, [
                    'notification_type' => 'new_cliq_payment',
                    'target_role'       => 'admin',
                    'content_en'        => 'A new CliQ payment has been submitted and is pending review.',
                    'content_ar'        => 'تم إرسال دفعة CliQ جديدة وهي قيد المراجعة.',
                    // if you have json data column:
                    // 'data' => ['payment_id' => $payment->id, 'user_id' => auth()->id()],
                ]);
            }

            // // 2) ✅ Notify User (optional)
            // $notificationService->create(auth()->user(), [
            //     'notification_type' => 'cliq_payment_submitted',
            //     'target_role'       => 'user',
            //     'content_en'        => 'Your CliQ payment was submitted successfully and is pending review.',
            //     'content_ar'        => 'تم إرسال دفعة CliQ بنجاح وهي قيد المراجعة.',
            //     // 'data' => ['payment_id' => $payment->id],
            // ]);

            // ============================
            // ✅ NOTIFICATIONS END HERE
            // ============================
            // ✅ Success response
            return response()->json([
                'success' => true,
                'message' => __('payment.cliq_success_message') ?? 'Payment submitted successfully.',
                'data'    => [
                    'payment_id' => $payment->id,
                    'package_name' => $package->package_name_en ?? '',
                    'amount' => $package->price,
                    'photo_url' => asset('storage/' . $photoPath),
                ],
            ], 201);
        } catch (\Exception $e) {
            // ✅ Catch any unexpected server errors
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
