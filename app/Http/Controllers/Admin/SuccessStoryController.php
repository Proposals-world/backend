<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SuccessStoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\UserFeedback;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index(SuccessStoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.SuccessStories.index');
    }

    public function show($id)
    {
        $feedback = UserFeedback::with(['match.user1', 'match.user2'])->findOrFail($id);

        return view('admin.SuccessStories.show', [
            'feedback' => $feedback,
            'user1' => $feedback->match->user1,
            'user2' => $feedback->match->user2,
            'outcome' => app()->getLocale() === 'ar'
                ? $feedback->feedback_text_ar
                : $feedback->feedback_text_en
        ]);
    }

    public function destroy(UserFeedback $feedback)
    {
        $feedback->delete();
        return response()->json(['message' => 'Success story deleted successfully']);
    }
}
