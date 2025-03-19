<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriptionPackagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionPackageRequest;

class SubscriptionPackageController extends Controller
{
    public function index(SubscriptionPackagesDataTable $dataTable)
    {
        return $dataTable->render('admin.SubscriptionPackage.index');
    }

    public function create()
    {
        return view('admin.SubscriptionPackage.create');
    }

    public function store(SubscriptionPackageRequest $request)
    {
        SubscriptionPackage::create($request->validated());

        return response()->json(['message' => 'Subscription package added successfully']);
    }

    public function edit($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);


        // Return the view with the subscriptionPackage, all features, and selected features for this package
        return view('admin.SubscriptionPackage.create', compact('subscriptionPackage'));
    }


    public function update(SubscriptionPackageRequest $request, $id)
    {
        // Find the package first
        $package = SubscriptionPackage::findOrFail($id);

        // Debugging: Check the request data
        // \Log::info('Updating Package', $request->validated());

        // Update the subscription package
        $package->update($request->validated());

        return response()->json(['message' => 'Subscription package updated successfully']);
    }
    public function destroy($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $package = SubscriptionPackage::findOrFail($id);

        // Delete the subscription package
        $package->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Subscription package deleted successfully']);
    }
}
