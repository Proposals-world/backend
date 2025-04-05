<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFeedbackRequest;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class UserFeedbackController extends Controller
{
    // public function store(StoreUserFeedbackRequest $request)
    // {
    //     $feedback = UserFeedback::create($request->validated());
    //     return new UserFeedbackResource($feedback);
    // }

    public function store(StoreUserFeedbackRequest $request): JsonResponse
    {
        $feedback = UserFeedback::create($request->validated());

        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback,
        ], 201);
    }
}
