<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PetsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    // Display the list of pets
    public function index(PetsDataTable $dataTable)
    {
        return $dataTable->render('admin.pets.index');
    }

    // Show the form to create a new pet
    public function create()
    {
        return view('admin.pets.create');
    }

    // Store a new pet
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Pet::create($request->all());

        return response()->json(['message' => 'Pet added successfully']);
    }

    // Show the form to edit an existing pet
    public function edit(Pet $pet)
    {
        return view('admin.pets.create', compact('pet'));
    }

    // Update an existing pet
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $pet->update($request->all());

        return response()->json(['message' => 'Pet updated successfully']);
    }

    // Delete a pet
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response()->json(['message' => 'Pet deleted successfully']);
    }
}
