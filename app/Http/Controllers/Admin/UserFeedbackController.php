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
        $validated = $request->validated();

        // Mapping directly inside controller
        $feedbackOptions = [
            'MarriageHappened' => [
                'en' => 'Marriage Happened',
                'ar' => 'تم الزواج'
            ],
            'Engaged' => [
                'en' => 'Engaged',
                'ar' => 'تمت الخطوبة'
            ],
            'StillTalking' => [
                'en' => 'Still Talking',
                'ar' => 'لا زلنا نتحدث'
            ],
            'NotCompatible' => [
                'en' => 'Not Compatible',
                'ar' => 'غير متوافقين'
            ],
            'Other' => [
                'en' => 'Other',
                'ar' => 'أخرى'
            ],
        ];

        $feedbackKey = $validated['feedback_text_en'];

        // Overwrite fields directly inside validated
        $validated['feedback_text_en'] = $feedbackOptions[$feedbackKey]['en'] ?? 'Other';
        $validated['feedback_text_ar'] = $feedbackOptions[$feedbackKey]['ar'] ?? 'أخرى';
        $validated['user_id'] = auth()->id();

        $feedback = UserFeedback::create($validated);

        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback,
        ], 201);
    }
}
