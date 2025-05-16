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

        $feedbackOptions = [
            'Contacted Successfully' => [
                'en' => 'Contacted Successfully',
                'ar' => 'تم التواصل بنجاح',
            ],
            'Guardian Was Cooperative' => [
                'en' => 'Guardian Was Cooperative',
                'ar' => 'الولي كان متعاونًا',
            ],
            'Guardian Was Not Cooperative' => [
                'en' => 'Guardian Was Not Cooperative',
                'ar' => 'الولي لم يكن متعاونًا',
            ],
            'Inappropriate Behavior' => [
                'en' => 'Inappropriate Behavior',
                'ar' => 'سلوك غير لائق',
            ],
            'No Response from Guardian' => [
                'en' => 'No Response from Guardian',
                'ar' => 'لا يوجد استجابة من الولي',
            ],
            'Engagement Happened' => [
                'en' => 'Engagement Happened',
                'ar' => 'حدثت خطوبة',
            ],
            'Marriage Happened' => [
                'en' => 'Marriage Happened',
                'ar' => 'تم الزواج',
            ],
            'Still in Communication' => [
                'en' => 'Still in Communication',
                'ar' => 'ما زلنا على تواصل',
            ],
            'Not Serious' => [
                'en' => 'Not Serious',
                'ar' => 'غير جاد',
            ],
        ];

        // Detect locale
        $locale = app()->getLocale();
        $feedbackKey = $locale === 'ar' ? $validated['feedback_text_ar'] : $validated['feedback_text_en'];

        // Now map properly both English and Arabic
        if (isset($feedbackOptions[$feedbackKey])) {
            $validated['feedback_text_en'] = $feedbackOptions[$feedbackKey]['en'];
            $validated['feedback_text_ar'] = $feedbackOptions[$feedbackKey]['ar'];
        } else {
            // fallback if not found
            $validated['feedback_text_en'] = 'Other';
            $validated['feedback_text_ar'] = 'أخرى';
        }

        $validated['user_id'] = auth()->id();

        $feedback = UserFeedback::create($validated);

        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback,
        ], 201);
    }
}
