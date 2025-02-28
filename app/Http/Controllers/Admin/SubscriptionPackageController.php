<?php

namespace App\Http\Controllers\admin;

use App\DataTables\SubscriptionPackagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        // Validate form data

        $validatedData = $request->validate([
            'package_name_en' => 'required|string|max:255',
            'package_name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1', // Duration in days
            'contact_limit' => 'required|integer|min:0', // New field

        ]);

        // Create the subscription package
        $subscriptionPackage = SubscriptionPackage::create($validatedData);


        return response()->json(['message' => 'Subscription package added successfully']);
    }

    public function edit($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);


        // Return the view with the subscriptionPackage, all features, and selected features for this package
        return view('admin.SubscriptionPackage.create', compact('subscriptionPackage'));
    }


    public function update(Request $request, SubscriptionPackage $package)
    {

        // Validate form data
        $validatedData = $request->validate([
            'subscription_package_id' => 'required',
            'package_name_en' => 'required|string|max:255',
            'package_name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'contact_limit' => 'required|integer|min:0',
        ]);
        // Update the subscription package
        // dd($request->all());
        $package->update($validatedData);


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
