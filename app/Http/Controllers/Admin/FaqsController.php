<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FaqsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en' => 'required|string|max:1000',
            'answer_ar' => 'required|string|max:1000',
        ]);

        Faq::create($request->all());

        return response()->json(['message' => 'FAQ added successfully']);
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.create', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en' => 'required|string|max:1000',
            'answer_ar' => 'required|string|max:1000',
        ]);

        $faq->update($request->all());

        return response()->json(['message' => 'FAQ updated successfully']);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully']);
    }
}
