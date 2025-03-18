<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecializationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

class SpecializationsController extends Controller
{
    public function index(SpecializationsDataTable $dataTable)
    {
        return $dataTable->render('admin.Specializations.index');
    }

    public function create()
    {
        return view('admin.Specializations.create');
    }

    public function store(LocalizationRequest $request)
    {
        Specialization::create($request->validated());

        return response()->json(['message' => 'Specialization added successfully']);
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.Specializations.create', compact('specialization'));
    }

    public function update(LocalizationRequest $request, Specialization $specialization)
    {
        $specialization->update($request->validated());

        return response()->json(['message' => 'Specialization updated successfully']);
    }
    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return response()->json(['message' => 'Specialization deleted successfully']);
    }
}
