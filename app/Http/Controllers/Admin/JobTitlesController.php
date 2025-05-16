<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobTitlesDataTable;
use App\Http\Controllers\Controller;
use App\Models\JobTitle;
use App\Http\Requests\LocalizationRequest;
use Illuminate\Http\Request;

class JobTitlesController extends Controller
{
    public function index(JobTitlesDataTable $dataTable)
    {
        return $dataTable->render('admin.Job title.index');
    }

    public function create()
    {
        return view('admin.Job title.create');
    }

    public function store(LocalizationRequest $request)
    {
        JobTitle::create($request->validated());

        return response()->json(['message' => 'Job Title added successfully']);
    }

    public function edit(JobTitle $jobTitle)
    {
        return view('admin.Job title.create', compact('jobTitle'));
    }

    public function update(LocalizationRequest $request, JobTitle $jobTitle)
    {
        $jobTitle->update($request->validated());

        return response()->json(['message' => 'Job Title updated successfully']);
    }

    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();

        return response()->json(['message' => 'Job Title deleted successfully']);
    }
}
