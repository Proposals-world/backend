<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReligionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

class ReligionController extends Controller
{
    public function index(ReligionsDataTable $dataTable)
    {
        return $dataTable->render('admin.religions.index');
    }

    public function create()
    {
        return view('admin.religions.create');
    }

    public function store(LocalizationRequest $request)
    {
        Religion::create($request->validated());

        return response()->json(['message' => 'Religion added successfully']);
    }
    public function edit(Religion $religion)
    {
        return view('admin.religions.create', compact('religion'));
    }

    public function update(LocalizationRequest $request, Religion $religion)
    {
        $religion->update($request->validated());

        return response()->json(['message' => 'Religion updated successfully']);
    }

    public function destroy(Religion $religion)
    {
        $religion->delete();

        return response()->json(['message' => 'Religion deleted successfully']);
    }
}
