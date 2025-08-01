<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// this for managing customers
class AdminController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.AdminUser.index');
    }


    public function create()
    {
        return view('admin.AdminUser.create'); // Ensure this view exists
    }
    public function edit(User $user)
    {
        return view('admin.AdminUser.create', compact('user')); // Ensure this view exists
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        User::create($validatedData);

        return response()->json(['message' => 'Admin created successfully'], 201);
    }


    public function update(Request $request, User $user)
    {
        $validatedData = $request->validated();

        $user->update($validatedData);

        return response()->json(['message' => 'Admin updated successfully']);
    }
    public function destroy(User $user)
    {
        try {
            // Prevent self-deletion
            if ($user->id === auth()->id()) {
                return response()->json(['message' => 'You cannot delete your own account.'], 403);
            }

            $user->delete();
            return response()->json(['message' => 'Admin deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete admin', 'message' => $e->getMessage()], 500);
        }
    }
    public function show(string $userid)
    {
        $user = User::with([
            'subscription.package',
            'profile' => function ($query) {
                $query->with([
                    'nationality',
                    'city',
                    'countryOfResidence',
                    'origin',
                    'religion',
                    'educationalLevel',
                    'specialization',
                    'jobTitle',
                    'sector',
                    'height',
                    'weight',
                    'drinkingStatus',
                    'socialMediaPresence',
                    'zodiacSign',
                    'eyeColor', // 👈 added
                    'cityLocation'
                ]);
            },
            'photos',
            'matches',
            'likes.likedUser.profile',
            'dislikes.dislikedUser.profile',
            'likedBy.user.profile',
            'dislikedBy.user.profile',


        ])->findOrFail($userid);
        $previous = User::where('id', '<', $user->id)
            ->orderBy('id', 'desc')
            ->first();
        $next     = User::where('id', '>', $user->id)
            ->orderBy('id', 'asc')
            ->first();
        $substatus = Subscription::where('user_id', $user->id)
            ->latest()
            ->value('status');

        // dd($subs);
        return view('admin.viewUser', compact('user', 'previous', 'next', 'substatus')); // Ensure this view exists
    }
}
