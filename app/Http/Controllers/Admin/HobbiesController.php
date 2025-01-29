<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HobbiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbiesController extends Controller
{
    public function index(HobbiesDataTable $dataTable)
    {
        return $dataTable->render('admin.hobbies.index');
    }

    public function create()
    {
        return view('admin.hobbies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Hobby::create($request->all());

        return response()->json(['message' => 'Hobby added successfully']);
    }

    public function edit(Hobby $hobby)
    {
        return view('admin.hobbies.create', compact('hobby'));
    }

    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $hobby->update($request->all());

        return response()->json(['message' => 'Hobby updated successfully']);
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();

        return response()->json(['message' => 'Hobby deleted successfully']);
    }
}
