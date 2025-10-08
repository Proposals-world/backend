<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Services\SubscriptionService;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(RegisterUserRequest $request, SubscriptionService $subscriptionService): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'first_name'     => $validated['first_name'],
            'last_name'      => $validated['last_name'],
            'email'          => $validated['email'],
            'country_code'   => $validated['country_code'],
            'phone_number'   => $validated['phone_number'] ?? null,
            'password'       => Hash::make($validated['password']),
            'profile_status' => 'active',
            'status'         => 'active',
            'gender'         => $validated['gender'],
            'role_id'        => 2,
        ]);

        event(new Registered($user));
        Auth::login($user);
        // Count how many users already registered
        $maleCount = User::where('gender', 'male')->count();
        $femaleCount = User::where('gender', 'female')->count();

        if (
            ($user->gender === 'male' && $maleCount <= 1000) ||
            ($user->gender === 'female' && $femaleCount <= 1000)
        ) {
            $packageId = $user->gender === 'male' ? 999 : 1000;
            $subscriptionService->createOrRenew($user->id, $packageId);
        }
        return redirect()->route('user.dashboard');
    }
}
