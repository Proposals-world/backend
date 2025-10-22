<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserRestoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Restore the authenticated user's soft-deleted account
     */

    public function restore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $lang = $request->getPreferredLanguage(['en', 'ar']);

        $service = new UserRestoreService($lang);
        $result = $service->restoreUser($request->email, $request->password);

        return response()->json([
            'message' => $result['message']
        ], $result['status']);
    }
}
