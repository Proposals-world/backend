<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFeedbackRequest;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserFeedback;
use App\Models\UserMatch;
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
        //dd($request->all());
        $validated = $request->validated();

        // 1) Normalize your feedback_text_en / feedback_text_ar as before…

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
            'Provided Guardian Number Invalid' => [
                'en' => 'Provided guardian number is not for a real guardian',
                'ar' => 'الرقم المقدم للولي ليس لولي أمر حقيقي',
            ],
        ];

        $locale      = app()->getLocale();
        $feedbackKey = $locale === 'ar'
            ? $validated['feedback_text_ar']
            : $validated['feedback_text_en'];

        if (isset($feedbackOptions[$feedbackKey])) {
            $validated['feedback_text_en'] = $feedbackOptions[$feedbackKey]['en'];
            $validated['feedback_text_ar'] = $feedbackOptions[$feedbackKey]['ar'];
        } else {
            $validated['feedback_text_en'] = 'Other';
            $validated['feedback_text_ar'] = 'أخرى';
        }

        // 2) Make sure you capture which match this feedback is for:
        //    e.g. your StoreUserFeedbackRequest should validate a `match_id` or `matched_user_id`.
        //    We'll assume you have $validated['match_id'] here.
        $validated['user_id'] = auth()->id();

        // 3) Save the feedback
        $feedback = UserFeedback::create($validated);

        // 4) If this was a “negative” reason, count how many negatives so far
        // count negative feedbacks
        $negativeTypes = ['Not Serious', 'Inappropriate Behavior'];
        $negCount = UserFeedback::where('match_id', $validated['match_id'])
            ->whereIn('feedback_text_en', $negativeTypes)
            ->count();

        if ($negCount >= 3 && $validated['match_id']) {
            // fetch the match record
            $match = \App\Models\UserMatch::find($validated['match_id']);
            if ($match) {
                // determine the “other” user in this match
                $otherUserId = $match->user1_id === auth()->id()
                    ? $match->user2_id
                    : $match->user1_id;

                // now update their status
                $other = \App\Models\User::find($otherUserId);
                if ($other) {
                    $other->status = 'inactive';
                    $other->save();
                }
            }
        }

        return response()->json([
            'message'  => 'Feedback submitted successfully',
            'feedback' => $feedback,
        ], 201);
    }
}
