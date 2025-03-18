<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminsStoreRequest;
use App\Http\Requests\Admin\AdminsUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'email_verified_at' => now(), // Mark email as verified
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
        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully.']);
    }
}
