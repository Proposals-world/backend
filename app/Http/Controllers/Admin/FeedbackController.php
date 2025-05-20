<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeedbacksDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFeedbackRequest;
use App\Models\UserFeedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     */
    public function index(FeedbacksDataTable $dataTable)
    {
        return $dataTable->render('admin.feedback.index');
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create(): View
    {
        return view('admin.feedback.create');
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(StoreUserFeedbackRequest $request): RedirectResponse
    {
        UserFeedback::create($request->validated());

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback created successfully');
    }

    /**
     * Show the form for editing the specified feedback.
     */
    public function edit(UserFeedback $feedback): View
    {
        return view('admin.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified feedback in storage.
     */
    public function update(StoreUserFeedbackRequest $request, UserFeedback $feedback): JsonResponse
    {
        $feedback->update($request->validated());

        return response()->json([
            'message' => 'Feedback updated successfully',
        ]);
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(UserFeedback $feedback): JsonResponse
    {
        $feedback->delete();

        return response()->json([
            'message' => 'Feedback deleted successfully',
        ]);
    }
}
