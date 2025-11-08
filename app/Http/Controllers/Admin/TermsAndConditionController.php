<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\TermsAndConditionsDataTable;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TermsAndConditionController extends Controller
{
    /**
     * Display the listing.
     */
    public function index(TermsAndConditionsDataTable $dataTable)
    {
        return $dataTable->render('admin.terms.index');
    }

    /**
     * Show the form for creating.
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    /**
     * Store a new term.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'version' => 'nullable|string|max:20',
            'effective_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // 🔥 Auto-generate slug
        $data['slug'] = Str::slug($data['title_en']);

        TermsAndCondition::create($data);

        return redirect()
            ->route('terms.index')
            ->with('success', '✅ Terms & Conditions created successfully.');
    }

    /**
     * Show the edit form.
     */
    public function edit($id)
    {
        $term = TermsAndCondition::findOrFail($id);
        return view('admin.terms.create', compact('term'));
    }

    /**
     * Update an existing term.
     */
    public function update(Request $request, $id)
    {
        $term = TermsAndCondition::findOrFail($id);

        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'version' => 'nullable|string|max:20',
            'effective_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title_en']);

        $term->update($data);

        return redirect()
            ->route('terms.index')
            ->with('success', '✅ Terms & Conditions updated successfully.');
    }

    /**
     * Delete a term.
     */
    public function destroy($id)
    {
        $term = TermsAndCondition::findOrFail($id);

        // 🚫 Prevent deleting if this is the only record
        if (TermsAndCondition::count() <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the only existing Terms & Conditions record.'
            ], 400);
        }

        // 🚫 Prevent deleting if this record is active
        if ($term->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete an active Terms & Conditions record. Please deactivate it first.'
            ], 400);
        }

        // ✅ Delete safely
        $term->delete();

        return response()->json([
            'success' => true,
            'message' => 'Terms & Conditions deleted successfully.'
        ]);
    }
    public function showTermsAndConditionsFrontend()
    {
        // Get the active record — if none marked active, get latest
        $term = TermsAndCondition::where('is_active', true)->latest('id')->first();

        if (!$term) {
            $term = TermsAndCondition::latest('id')->first();
        }

        // Pass to frontend view
        return view('TermsAndConditions', compact('term'));
    }
}
