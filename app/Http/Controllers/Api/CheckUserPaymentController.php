<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserPaymentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'package_id' => 'required|exists:subscription_packages,id',
                'email' => 'required|email',
                'amount' => 'required|numeric',
                'date' => 'required|date',
            ]);

            $payment = CheckUserPayment::create([
                'user_id' => Auth::id(),
                'package_id' => $validated['package_id'],
                'email' => $validated['email'],
                'amount' => $validated['amount'],
                'date' => $validated['date'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment record created successfully.',
                'data' => $payment,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
