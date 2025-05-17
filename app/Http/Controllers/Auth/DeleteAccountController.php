<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DeleteAccountController extends Controller
{
    /**
     * Show the delete-account confirmation form.
     */
    public function confirm()
    {
        return view('auth.delete-account');
    }

    /**
     * Handle the account deletion.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => __('The provided password does not match our records.'),
            ]);
        }

        Auth::logout();

        // Delete the user
        $user->delete();

        // Invalidate session & regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('status', __('Your account has been deleted.'));
    }
}
