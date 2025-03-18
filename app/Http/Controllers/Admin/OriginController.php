<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OriginsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Origin;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OriginsDataTable $dataTable)
    {
        return $dataTable->render('admin.origins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.origins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalizationRequest $request)
    {
        Origin::create($request->validated());

        return response()->json(['message' => 'Origin added successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Origin $origin)
    {
        return view('admin.origins.create', compact('origin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalizationRequest $request, Origin $origin)
    {
        $origin->update($request->validated());

        return response()->json(['message' => 'Origin updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Origin $origin)
    {
        $origin->delete();

        return response()->json(['message' => 'Origin deleted successfully']);
    }
}
