<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReligionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Religion::create($request->all());

        return response()->json(['message' => 'Religion added successfully']);
    }

    public function edit(Religion $religion)
    {
        return view('admin.religions.create', compact('religion'));
    }

    public function update(Request $request, Religion $religion)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $religion->update($request->all());

        return response()->json(['message' => 'Religion updated successfully']);
    }

    public function destroy(Religion $religion)
    {
        $religion->delete();

        return response()->json(['message' => 'Religion deleted successfully']);
    }
}
