<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MarriageBudgetsDataTable;
use App\Http\Controllers\Controller;
use App\Models\MarriageBudget;
use Illuminate\Http\Request;
use App\Http\Requests\MarriageBudgetRequest;

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

    public function store(MarriageBudgetRequest $request)
    {
        MarriageBudget::create($request->validated());

        return response()->json(['message' => 'Marriage budget added successfully']);
    }
    public function edit(MarriageBudget $marriageBudget)
    {
        return view('admin.marriageBudgets.create', compact('marriageBudget'));
    }

    public function update(MarriageBudgetRequest $request, MarriageBudget $marriageBudget)
    {
        $marriageBudget->update($request->validated());

        return response()->json(['message' => 'Marriage budget updated successfully']);
    }

    public function destroy(MarriageBudget $marriageBudget)
    {
        $marriageBudget->delete();

        return response()->json(['message' => 'Marriage budget deleted successfully']);
    }
}
