<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DrinkingStatusesDataTable;
use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        DrinkingStatus::create($request->all());

        return response()->json(['message' => 'Drinking status added successfully']);
    }

    public function edit(DrinkingStatus $drinkingStatus)
    {
        return view('admin.drinkingStatus.create', compact('drinkingStatus'));
    }

    public function update(Request $request, DrinkingStatus $drinkingStatus)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $drinkingStatus->update($request->all());

        return response()->json(['message' => 'Drinking status updated successfully']);
    }

    public function destroy(DrinkingStatus $drinkingStatus)
    {
        $drinkingStatus->delete();

        return response()->json(['message' => 'Drinking status deleted successfully']);
    }
}
