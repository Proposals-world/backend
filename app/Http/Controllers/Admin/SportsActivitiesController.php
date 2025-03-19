<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SportsActivitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\SportsActivity;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

class SportsActivitiesController extends Controller
{
    public function index(SportsActivitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.sportsActivities.index');
    }

    public function create()
    {
        return view('admin.sportsActivities.create');
    }

    public function store(LocalizationRequest $request)
    {
        SportsActivity::create($request->validated());

        return response()->json(['message' => 'Sports activity added successfully']);
    }

    public function edit(SportsActivity $sportsActivity)
    {
        return view('admin.sports activities.create', compact('sportsActivity'));
    }

    public function update(LocalizationRequest $request, SportsActivity $sportsActivity)
    {
        $sportsActivity->update($request->validated());

        return response()->json(['message' => 'Sports activity updated successfully']);
    }

    public function destroy(SportsActivity $sportsActivity)
    {
        $sportsActivity->delete();

        return response()->json(['message' => 'Sports activity deleted successfully']);
    }
}
