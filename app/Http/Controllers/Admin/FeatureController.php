<?php

namespace App\Http\Controllers\admin;

use App\DataTables\FeaturesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(FeaturesDataTable $dataTable)
    {
        return $dataTable->render('admin.feature.index');
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function store(Request $request)
    {
        Feature::create($request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]));

        return response()->json(['message' => 'feature added successfully']);
    }

    public function edit(Feature $feature)
    {
        return view('admin.feature.create', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $feature->update($request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]));

        return response()->json(['message' => 'Feature updated successfully']);
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(['message' => 'Feature deleted successfully']);
    }
}
