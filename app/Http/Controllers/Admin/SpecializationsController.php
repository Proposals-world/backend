<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecializationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationsController extends Controller
{
    public function index(SpecializationsDataTable $dataTable)
    {
        return $dataTable->render('admin.specializations.index');
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Specialization::create($request->all());

        return response()->json(['message' => 'Specialization added successfully']);
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.specializations.create', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $specialization->update($request->all());

        return response()->json(['message' => 'Specialization updated successfully']);
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return response()->json(['message' => 'Specialization deleted successfully']);
    }
}
