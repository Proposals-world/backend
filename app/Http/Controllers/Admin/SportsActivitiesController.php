<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SportsActivitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\SportsActivity;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        SportsActivity::create($request->all());

        return response()->json(['message' => 'Sports activity added successfully']);
    }

    public function edit(SportsActivity $sportsActivity)
    {
        return view('admin.sports activities.create', compact('sportsActivity'));
    }

    public function update(Request $request, SportsActivity $sportsActivity)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $sportsActivity->update($request->all());

        return response()->json(['message' => 'Sports activity updated successfully']);
    }

    public function destroy(SportsActivity $sportsActivity)
    {
        $sportsActivity->delete();

        return response()->json(['message' => 'Sports activity deleted successfully']);
    }
}
