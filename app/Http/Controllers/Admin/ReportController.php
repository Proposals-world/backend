<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReportsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\UserReport;
use Illuminate\Http\Request;

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

    // Store a newly created report
    public function store(Request $request)
    {
        // You can perform validation here or use a custom request for it
        UserReport::create($request->all());

        return response()->json(['message' => 'Report added successfully']);
    }

    // Show the form for editing an existing report
    public function edit(UserReport $report)
    {
        // Pass the report to the edit view
        return view('admin.reports.edit', compact('report'));
    }

    // Update the specified report
    public function update(Request $request, UserReport $report)
    {
        // Update the report with the validated data
        $report->update($request->all());

        return response()->json(['message' => 'Report updated successfully']);
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
