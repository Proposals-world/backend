<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocalizationRequest;

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
    public function store(LocalizationRequest $request)
    {
        Pet::create($request->validated());

        return response()->json(['message' => 'Pet added successfully']);
    }

    // Show the form to edit an existing pet
    public function edit(Pet $pet)
    {
        return view('admin.pets.create', compact('pet'));
    }

    // Update an existing pet
    public function update(LocalizationRequest $request, Pet $pet)
    {
        $pet->update($request->validated());

        return response()->json(['message' => 'Pet updated successfully']);
    }

    // Delete a pet
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response()->json(['message' => 'Pet deleted successfully']);
    }
}
