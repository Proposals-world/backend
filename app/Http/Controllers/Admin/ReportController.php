<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReportsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\UserReport;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserReportRequest;
use App\Models\User;
use App\Services\UserSuspensionService;

class ReportController extends Controller
{
    // Display a listing of the reports
    public function index(ReportsDataTable $dataTable)
    {
        // Return the DataTable view for reports
        return $dataTable->render('admin.reports.index');
    }

    // Show the form for creating a new report (optional, as reports may be created by other means)
    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(StoreUserReportRequest $request, UserSuspensionService $suspensionService)
    {
        try {
            $data = $request->validated();
            $data['reporter_id'] = auth()->id();

            $lang = $request->header('lang', app()->getLocale());

            $reasonTranslations = [
                'Inappropriate Photos' => 'صور غير لائقة',
                'Offensive Language' => 'ألفاظ مسيئة',
                'Spam or Advertising' => 'رسائل مزعجة أو إعلانات',
                'Other' => 'أخرى',
            ];

            if ($lang === 'en') {
                $data['reason_ar'] = $reasonTranslations[$data['reason_en']] ?? 'أخرى';
            } else {
                $data['reason_en'] = array_search($data['reason_ar'], $reasonTranslations) ?: 'Other';
            }

            // 🛠️ احفظ نص المستخدم الذي كتب في Other Reason
            if (strtolower($data['reason_en']) === 'other') {
                $data['other_reason_en'] = $request->input('other_reason_en') ?? null;
                $data['other_reason_ar'] = $request->input('other_reason_ar') ?? null;
            }

            $existingReportsCount = UserReport::where('reported_id', $data['reported_id'])
                ->count();

            $data['report_count'] = $existingReportsCount + 1;
            if (
                (isset($data['reason_en']) && strcasecmp($data['reason_en'], 'Inappropriate Photos') === 0)
                || (isset($data['reason_ar']) && $data['reason_ar'] === 'صور غير لائقة')
            ) {
                $reportedUser = User::find($data['reported_id']);
                $data['reported_photo'] = $reportedUser ? ($reportedUser->photos()->first()->photo_url ?? null) : null;
            } else {
                $data['reported_photo'] = null;
            }
            // dd($data);

            UserReport::create($data);
            // Check if this is the 3rd report and suspend the account if needed
            if ($data['report_count'] >= 3) {
                $reportedUser = User::find($data['reported_id']);
                if ($reportedUser && $reportedUser->status !== 'suspended') {
                    $suspensionService->suspendUser($reportedUser);
                }
            }
            return response()->json(['message' => 'Report added successfully'], 201);
        } catch (\Throwable $e) {
            \Log::error('Error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'An error occurred while submitting the report. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    // Show the form for editing an existing report
    public function edit(UserReport $report)
    {
        // Pass the report to the edit view
        return view('admin.reports.edit', compact('report'));
    }

    public function update(StoreUserReportRequest $request, UserReport $report)
    {
        try {
            $data = $request->validated();
            $data['reporter_id'] = auth()->id();

            // Map English reason to Arabic
            $reasonTranslations = [
                'Inappropriate Photos'       => 'صور غير لائقة',
                'Harassment'                 => 'تحرش',
                'Disrespectful Behavior'      => 'سلوك غير محترم',
                'Asking for Haram (Forbidden)' => 'طلب أمور محرمة',
                'Fake Profile'               => 'ملف شخصي مزيف',
                'Spam or Advertising'        => 'رسائل مزعجة أو إعلانات',
                'Offensive Language'         => 'ألفاظ مسيئة',
                'Not Serious About Marriage' => 'عدم الجدية في الزواج',
                'Misleading Information'     => 'معلومات مضللة',
                'Other'                      => 'أخرى',
            ];

            $data['reason_ar'] = $reasonTranslations[$data['reason_en']] ?? 'أخرى';

            $report->update($data);

            return response()->json(['message' => 'Report updated successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error occurred while updating the report. Please try again.',
            ], 500);
        }
    }

    // Update the specified report
    public function updateStatus(Request $request, $id)
    {
        // Find the report by ID
        $report = UserReport::findOrFail($id);

        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,rejected',
        ]);

        // Update the status
        $report->status = $request->input('status');
        $report->save();

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Status updated successfully!');
    }


    // Remove the specified report
    public function destroy(UserReport $report)
    {
        // Delete the report
        $report->delete();

        return response()->json(['message' => 'Report deleted successfully']);
    }
}
