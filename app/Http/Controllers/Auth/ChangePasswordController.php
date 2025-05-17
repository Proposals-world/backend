<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    /**
     * Show the change-password form.
     */
    public function edit()
    {
        return view('auth.change-password');
    }

    /**
     * Handle the form submission and update the password.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|confirmed|min:8',
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => __('The provided password does not match your current password.'),
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.dashboard')->with('status', __('Password changed successfully.'));
    }
}
