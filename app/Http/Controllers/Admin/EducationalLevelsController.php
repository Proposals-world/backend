<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EducationalLevelsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalizationRequest;
use App\Models\EducationalLevel;
use Illuminate\Http\Request;

class EducationalLevelsController extends Controller
{
    public function index(EducationalLevelsDataTable $dataTable)
    {
        return $dataTable->render('admin.educationalLevels.index');
    }

    public function create()
    {
        return view('admin.educationalLevels.create');
    }

    public function store(LocalizationRequest $request)
    {
        EducationalLevel::create($request->validated());

        return response()->json(['message' => 'Educational Level created successfully'], 201);
    }
    public function edit(EducationalLevel $educationalLevel)
    {
        return view('admin.educationalLevels.create', compact('educationalLevel'));
    }

    public function update(LocalizationRequest $request, EducationalLevel $educationalLevel)
    {


        $educationalLevel->update($request->validated());

        return response()->json(['message' => 'Educational Level updated successfully']);
    }

    public function destroy(EducationalLevel $educationalLevel)
    {
        $educationalLevel->delete();

        return response()->json(['message' => 'Educational Level deleted successfully']);
    }
}
