<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HobbiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

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

    public function store(LocalizationRequest $request)
    {
        Hobby::create($request->validated());

        return response()->json(['message' => 'Hobby added successfully']);
    }

    public function edit(Hobby $hobby)
    {
        return view('admin.hobbies.create', compact('hobby'));
    }

    public function update(LocalizationRequest $request, Hobby $hobby)
    {
        $hobby->update($request->validated());

        return response()->json(['message' => 'Hobby updated successfully']);
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();

        return response()->json(['message' => 'Hobby deleted successfully']);
    }
}
