<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HairColorsDataTable;
use App\Http\Controllers\Controller;
use App\Models\HairColor;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

class HairColorsController extends Controller
{
    // Display the list of hair colors
    public function index(HairColorsDataTable $dataTable)
    {
        return $dataTable->render('admin.hairColors.index');
    }

    // Show the form to create a new hair color
    public function create()
    {
        return view('admin.hairColors.create');
    }

    // Store a new hair color
    public function store(LocalizationRequest $request)
    {
        HairColor::create($request->validated());

        return response()->json(['message' => 'Hair color added successfully'], 201);
    }
    // Show the form to edit an existing hair color
    public function edit(HairColor $hairColor)
    {
        return view('admin.hairColors.create', compact('hairColor'));
    }

    // Update an existing hair color
    public function update(LocalizationRequest $request, HairColor $hairColor)
    {
        $hairColor->update($request->validated());

        return response()->json(['message' => 'Hair color updated successfully']);
    }
    // Delete a hair color
    public function destroy(HairColor $hairColor)
    {
        $hairColor->delete();

        return response()->json(['message' => 'Hair color deleted successfully']);
    }
}
