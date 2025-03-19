<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DrinkingStatusesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalizationRequest;
use App\Models\DrinkingStatus;
use Illuminate\Http\Request;

class DrinkingStatusesController extends Controller
{
    public function index(DrinkingStatusesDataTable $dataTable)
    {
        return $dataTable->render('admin.drinkingStatus.index');
    }

    public function create()
    {
        return view('admin.drinkingStatus.create');
    }

    public function store(LocalizationRequest $request)
    {
        DrinkingStatus::create($request->validated());

        return redirect()->route('drinking-status.index')->with('success', 'Drinking status added successfully');
    }

    public function edit(DrinkingStatus $drinkingStatus)
    {
        return view('admin.drinkingStatus.create', compact('drinkingStatus'));
    }

    public function update(LocalizationRequest $request, DrinkingStatus $drinkingStatus)
    {

        $drinkingStatus->update($request->validated());

        return response()->json(['message' => 'Drinking status updated successfully']);
    }

    public function destroy(DrinkingStatus $drinkingStatus)
    {
        $drinkingStatus->delete();

        return response()->json(['message' => 'Drinking status deleted successfully']);
    }
}
