<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserDeletionService;

class DeleteAccountController extends Controller
{
    protected $userDeletionService;

    /**
     * Constructor to inject the UserDeletionService.
     */
    public function __construct(UserDeletionService $userDeletionService)
    {
        $this->userDeletionService = $userDeletionService;
    }

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
        return $this->userDeletionService->deleteUser($request);
    }
}
