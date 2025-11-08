<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\CancellationRefundPoliciesDataTable;
use App\Models\CancellationRefundPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CancellationRefundPolicyController extends Controller
{
    /**
     * Display all cancellation/refund policies.
     */
    public function index(CancellationRefundPoliciesDataTable $dataTable)
    {
        return $dataTable->render('admin.cancellation.index');
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('admin.cancellation.create');
    }

    /**
     * Store a new cancellation/refund policy.
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

        // 🔥 Auto-generate slug from English title
        $data['slug'] = Str::slug($data['title_en']);

        CancellationRefundPolicy::create($data);

        return redirect()
            ->route('cancellation.index')
            ->with('success', '✅ Cancellation & Refund Policy created successfully.');
    }

    /**
     * Show the edit form.
     */
    public function edit($id)
    {
        $policy = CancellationRefundPolicy::findOrFail($id);
        return view('admin.cancellation.create', compact('policy'));
    }

    /**
     * Update an existing policy.
     */
    public function update(Request $request, $id)
    {
        $policy = CancellationRefundPolicy::findOrFail($id);

        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'version' => 'nullable|string|max:20',
            'effective_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // 🔥 Auto-generate slug again for consistency
        $data['slug'] = Str::slug($data['title_en']);

        $policy->update($data);

        return redirect()
            ->route('cancellation.index')
            ->with('success', '✅ Cancellation & Refund Policy updated successfully.');
    }

    /**
     * Delete a cancellation/refund policy.
     */
    public function destroy($id)
    {
        $policy = CancellationRefundPolicy::findOrFail($id);

        // 🚫 Prevent deleting if this is the only record
        if (CancellationRefundPolicy::count() <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the only existing policy.'
            ], 400);
        }

        // 🚫 Prevent deleting if it's active
        if ($policy->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete an active policy. Please deactivate it first.'
            ], 400);
        }

        // ✅ Delete safely
        $policy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Policy deleted successfully.'
        ]);
    }
    public function showCancellationRefundPolicyFrontend()
    {
        // Get the active policy — if none marked active, get latest
        $policy = \App\Models\CancellationRefundPolicy::where('is_active', true)->latest('id')->first();

        if (!$policy) {
            $policy = \App\Models\CancellationRefundPolicy::latest('id')->first();
        }

        // Pass to frontend view
        return view('CancellationRefundPolicy', compact('policy'));
    }
}
