<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FaqsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;

class FaqsController extends Controller
{
    public function index(FaqsDataTable $dataTable)
    {
        return $dataTable->render('admin.faqs.index');
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(FaqRequest $request)
    {
        Faq::create($request->validated());

        return response()->json(['message' => 'FAQ added successfully']);
    }
    public function edit(Faq $faq)
    {
        return view('admin.faqs.create', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return response()->json(['message' => 'FAQ updated successfully']);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully']);
    }
}
