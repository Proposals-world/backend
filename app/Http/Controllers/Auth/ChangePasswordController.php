<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PasswordUpdateService;
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
    protected $passwordUpdateService;
    /**
     * Inject the password update service.
     */
    public function __construct(PasswordUpdateService $passwordUpdateService)
    {
        $this->passwordUpdateService = $passwordUpdateService;
    }

    /**
     * Handle the form submission and update the password.
     */
    public function update(Request $request)
    {
        return $this->passwordUpdateService->updatePassword($request);
    }
}
