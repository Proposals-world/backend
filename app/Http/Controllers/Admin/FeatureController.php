<?php

namespace App\Http\Controllers\admin;

use App\DataTables\FeaturesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

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

    public function store(LocalizationRequest $request)
    {
        Feature::create($request->validated());

        return response()->json(['message' => 'Feature added successfully'], 201);
    }

    public function edit(Feature $feature)
    {
        return view('admin.feature.create', compact('feature'));
    }

    public function update(LocalizationRequest $request, Feature $feature)
    {
        $feature->update($request->validated());

        return response()->json(['message' => 'Feature updated successfully']);
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(['message' => 'Feature deleted successfully']);
    }
}
