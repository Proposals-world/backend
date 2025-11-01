<?php

// app/Http/Controllers/Api/ReportController.php
namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Support\Facades\Auth;
use App\Services\UserSuspensionService;

class ReportController extends Controller
{
    public function store(ReportRequest $request, UserSuspensionService $suspensionService)
    {
        // Check if the user has already reported the same user
        $existingReport = UserReport::where('reported_id', $request->reported_id)
            ->where('reporter_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existingReport) {
            if ($existingReport->status === 'pending') {
                return response()->json([
                    'message' => 'You have already reported this user, and it is under review.',
                ], 400);
            }
        }

        // Prepare base data
        $data = array_merge(
            $request->validated(),
            ['reporter_id' => Auth::id()]
        );

        // // ✅ Handle photo upload
        // if ($request->hasFile('photo')) {
        //     // Store in /storage/app/public/reports
        //     $path = $request->file('photo')->store('reports', 'public');
        //     $data['photo_path'] = $path;
        // }
        if ($request->reason === 'Inappropriate Photos' || $request->reason === 'صور غير لائقة') {
            $data['reported_photo'] = User::find($data['reported_id'])->photos()->first()->photo_url ?? null;
        }

        // Store report
        $report = UserReport::create($data);
        // Count all reports for this user (including this new one)
        $reportCount = UserReport::where('reported_id', $request->reported_id)
            ->count();

        // Check if report count reached threshold (3)
        if ($reportCount >= 3) {
            $reportedUser = User::find($request->reported_id);

            if ($reportedUser && $reportedUser->status !== 'suspended') {
                $suspensionService->suspendUser($reportedUser);
            }
        }
        // Return a success message along with the report data
        return response()->json([
            'message' => 'Report created successfully.',
            'data' => new ReportResource($report),
        ], 201);
    }

    // Get all reports
    public function index()
    {
        $reports = UserReport::with(['reporter', 'reportedUser'])->get();
        return response()->json($reports);
    }

    // Show a specific report
    public function show($id)
    {
        $report = UserReport::with(['reporter', 'reportedUser'])->findOrFail($id);
        return response()->json($report);
    }

    // Update a report
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => 'nullable|string',
            'status' => 'required|in:pending,resolved,rejected',
        ]);

        $report = UserReport::findOrFail($id);
        $report->update($validated);

        return response()->json($report);
    }

    // Delete a report
    public function destroy($id)
    {
        $report = UserReport::findOrFail($id);
        $report->delete();

        return response()->json(null, 204);
    }
}
