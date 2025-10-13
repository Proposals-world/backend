<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUserPayment;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckUserPaymentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'package_id' => 'required|exists:subscription_packages,id',
                // 'email'      => 'required|email',
                // 'amount'     => 'required|numeric',
                // 'date'       => 'required|date',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors occurred.',
                    'errors'  => $validator->errors(), // 👈 Returns each field error separately
                ], 422);
            }
            $validated = $validator->validated();
            // dd(SubscriptionPackage::find($validated['package_id']));
            $payment = CheckUserPayment::create([
                'user_id' => Auth::id(),
                'package_id' => $validated['package_id'],
                'email' => Auth::user()->email,
                'amount' => SubscriptionPackage::find($validated['package_id'])->price,
                'date' => now(),
            ]);


            // Remove user_id from the response data
            $responseData = $payment->toArray();
            unset($responseData['user_id']);

            return response()->json([
                'success' => true,
                'message' => 'Payment record created successfully.',
                'data' => $responseData,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
