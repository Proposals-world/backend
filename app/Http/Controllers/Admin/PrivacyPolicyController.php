<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\PrivacyPoliciesDataTable;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrivacyPolicyController extends Controller
{
    /**
     * Display the listing of privacy policies.
     */
    public function index(PrivacyPoliciesDataTable $dataTable)
    {
        return $dataTable->render('admin.privacy.index');
    }

    /**
     * Show the form for creating a new privacy policy.
     */
    public function create()
    {
        return view('admin.privacy.create');
    }

    /**
     * Store a newly created privacy policy.
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

        PrivacyPolicy::create($data);

        return redirect()
            ->route('privacy.index')
            ->with('success', '✅ Privacy Policy created successfully.');
    }

    /**
     * Show the form for editing the specified privacy policy.
     */
    public function edit($id)
    {
        $policy = PrivacyPolicy::findOrFail($id);
        return view('admin.privacy.create', compact('policy'));
    }

    /**
     * Update the specified privacy policy.
     */
    public function update(Request $request, $id)
    {
        $policy = PrivacyPolicy::findOrFail($id);

        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'version' => 'nullable|string|max:20',
            'effective_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // 🔥 Auto-generate slug again
        $data['slug'] = Str::slug($data['title_en']);

        $policy->update($data);

        return redirect()
            ->route('privacy.index')
            ->with('success', '✅ Privacy Policy updated successfully.');
    }

    /**
     * Remove the specified privacy policy.
     */
    public function destroy($id)
    {
        $policy = PrivacyPolicy::findOrFail($id);

        // 🚫 Prevent deleting if this is the only record
        if (PrivacyPolicy::count() <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the only existing Privacy Policy record.'
            ], 400);
        }

        // 🚫 Prevent deleting if this record is active
        if ($policy->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete an active Privacy Policy record. Please deactivate it first.'
            ], 400);
        }

        // ✅ Delete safely
        $policy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Privacy Policy deleted successfully.'
        ]);
    }
    public function showPrivacyPolicyFrontend()
    {
        // Get the active privacy policy — if none marked active, get latest
        $policy = PrivacyPolicy::where('is_active', true)->latest('id')->first();

        if (!$policy) {
            $policy = PrivacyPolicy::latest('id')->first();
        }

        // Pass to frontend view
        return view('PrivacyPolicy', compact('policy'));
    }
}
