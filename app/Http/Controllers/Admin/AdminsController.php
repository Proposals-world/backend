<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminsStoreRequest;
use App\Http\Requests\Admin\AdminsUpdateRequest;
use App\Models\AdminPermission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminsDataTable $dataTable)
    {
        return $dataTable->render('admin.users.admins.index');
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return view('admin.users.admins.create');
    }

    /**
     * Store a newly created admin.
     */
    public function store(AdminsStoreRequest $request)
    {
        $validatedData = $request->validated();
        $admin = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Admin role
            'status' => 'active',
            'gender' => $request->gender,
            'email_verified_at' => now(), // Mark email as verified
        ]);
        AdminPermission::create([
            'user_id' => $admin->id,   // link to the newly created user
            'can_create' => false,
            'can_edit' => false,
            'can_delete' => false,
            'can_view' => true,       // default permissions
            'can_manage_roles' => false,
        ]);

        return response()->json(['message' => 'Admin created successfully.']);
    }

    /**
     * Show the form for editing an admin.
     */
    public function edit(User $admin)
    {
        return view('admin.users.admins.create', compact('admin'));
    }

    /**
     * Update the specified admin.
     */
    public function update(AdminsUpdateRequest $request, User $admin)
    {
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return response()->json(['message' => 'Admin updated successfully.']);
    }

    /**
     * Remove the specified admin.
     */
    public function destroy(User $admin)
    {
        // Retrieve the admin's permissions
        $user = auth()->user(); // currently logged-in user
        $permissions = $user->adminPermission;
        if (!$permissions) {
            return response()->json([
                'message' => 'No permission record found for this admin.'
            ], 403);
        }
        if (!$permissions->can_delete) {
            return response()->json([
                'message' => 'You are not authorized to delete this admin.'
            ], 403);
        }

        // Delete the user
        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully.']);
    }
    /**
     * Deactivate the specified admin.
     */
    public function deactivate(Request $request, string $id)
    {
        // Retrieve the user by ID
        $admin = User::findOrFail($id);
        // dd($request->all());
        // Get the status input from the form
        // $newStatus = $request->input('status');  // Use $request, not the facade

        // Update the user's status
        $admin->update(['status' => 'inactive']);

        // Return a redirect with a success message
        return redirect()->back()->with('message', 'User deactivated successfully.');
    }
    public function active(string $id)
    {
        // Retrieve the user by ID
        $admin = User::findOrFail($id);
        // dd($request->all());
        // Get the status input from the form
        // $newStatus = $request->input('status');  // Use $request, not the facade

        // Update the user's status
        $admin->update(['status' => 'active']);

        // Return a redirect with a success message
        return redirect()->back()->with('message', 'User deactivated successfully.');
    }
}
