<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MarriageBudgetsDataTable;
use App\Http\Controllers\Controller;
use App\Models\MarriageBudget;
use Illuminate\Http\Request;

class MarriageBudgetsController extends Controller
{
    public function index(MarriageBudgetsDataTable $dataTable)
    {
        return $dataTable->render('admin.marriageBudgets.index');
    }

    public function create()
    {
        return view('admin.marriageBudgets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'budget_en' => 'required|string|max:255',
            'budget_ar' => 'required|string|max:255',
        ]);

        MarriageBudget::create($request->all());

        return response()->json(['message' => 'Marriage budget added successfully']);
    }

    public function edit(MarriageBudget $marriageBudget)
    {
        return view('admin.marriageBudgets.create', compact('marriageBudget'));
    }

    public function update(Request $request, MarriageBudget $marriageBudget)
    {
        $request->validate([
            'budget_en' => 'required|string|max:255',
            'budget_ar' => 'required|string|max:255',
        ]);

        $marriageBudget->update($request->all());

        return response()->json(['message' => 'Marriage budget updated successfully']);
    }

    public function destroy(MarriageBudget $marriageBudget)
    {
        $marriageBudget->delete();

        return response()->json(['message' => 'Marriage budget deleted successfully']);
    }
}
