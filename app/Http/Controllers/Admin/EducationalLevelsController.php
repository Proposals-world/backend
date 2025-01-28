<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EducationalLevelsDataTable;
use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        EducationalLevel::create($request->all());

        return response()->json(['message' => 'Educational Level added successfully']);
    }

    public function edit(EducationalLevel $educationalLevel)
    {
        return view('admin.educationalLevels.create', compact('educationalLevel'));
    }

    public function update(Request $request, EducationalLevel $educationalLevel)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $educationalLevel->update($request->all());

        return response()->json(['message' => 'Educational Level updated successfully']);
    }

    public function destroy(EducationalLevel $educationalLevel)
    {
        $educationalLevel->delete();

        return response()->json(['message' => 'Educational Level deleted successfully']);
    }
}
