<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RedeemDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\ContactRedeemedMail;
use Illuminate\Support\Facades\Mail;

class RedeemController extends Controller
{
    public function index(RedeemDataTable $dataTable)
    {
        return $dataTable->render('admin.redeem.index');
    }

    public function redeem(User $user)
    {
        $subscription = $user->subscription()->where('status', 'active')->first();

        if ($subscription) {
            $subscription->increment('contacts_remaining');

            // Determine user language
            $lang = $user->preferred_language ?? 'en';

            // Send email
            Mail::to($user->email)->send(new ContactRedeemedMail($user, $lang));

            return response()->json(['message' => 'Contact redeemed successfully']);
        }

        return response()->json(['message' => 'No active subscription found'], 400);
    }
}
