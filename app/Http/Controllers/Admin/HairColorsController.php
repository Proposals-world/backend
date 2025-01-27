<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HairColorsDataTable;
use App\Http\Controllers\Controller;
use App\Models\HairColor;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        HairColor::create($request->all());

        return response()->json(['message' => 'Hair color added successfully']);
    }

    // Show the form to edit an existing hair color
    public function edit(HairColor $hairColor)
    {
        return view('admin.hairColors.create', compact('hairColor'));
    }

    // Update an existing hair color
    public function update(Request $request, HairColor $hairColor)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $hairColor->update($request->all());

        return response()->json(['message' => 'Hair color updated successfully']);
    }

    // Delete a hair color
    public function destroy(HairColor $hairColor)
    {
        $hairColor->delete();

        return response()->json(['message' => 'Hair color deleted successfully']);
    }
}
