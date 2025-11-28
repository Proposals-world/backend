<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $email = strtolower(trim($request->email));

        // 1️⃣ Check if user exists including soft-deleted
        $user = User::withTrashed()
            ->whereRaw('LOWER(email) = ?', [$email])
            ->first();

        // 2️⃣ If user is soft-deleted → show restore button
        if ($user && $user->deleted_at !== null) {
            return back()->withErrors([
                'email' =>
                "Your account has been deleted.<br>" .
                    '<a href="' . route('restore-my-account', ['email' => $email]) . '"
                    class="text-primary font-medium">
                    Restore Account
                </a>',
            ]);
        }

        // 3️⃣ Proceed with normal breeze login
        $credentials = ['email' => $email, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => __('auth.failed'),
            ]);
        }

        // 4️⃣ Additional status check
        $user = User::where('email', $email)->first();

        if ($user->status !== 'active' && $user->status != "suspended") {
            Auth::logout();

            return back()->withErrors([
                'email' => __('validation.account_not_active'),
            ]);
        }

        // 5️⃣ Success → regenerate session
        $request->session()->regenerate();

        // 6️⃣ Redirect based on role
        if ($user->role_id == 1) {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role_id == 2) {
            return redirect()->intended(route('user.dashboard'));
        }

        return redirect('/');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
