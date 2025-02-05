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
        $features = Feature::all(); // Fetch features to show in the form
        return view('admin.SubscriptionPackage.create', compact('features'));
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
            'features' => 'nullable|array', // Features can be null or an array of selected feature IDs
            'features.*' => 'exists:features,id', // Ensure the selected features exist
        ]);

        // Create the subscription package
        $subscriptionPackage = SubscriptionPackage::create($validatedData);

        // Attach selected features to the subscription package (many-to-many relationship)
        if (isset($validatedData['features'])) {
            $subscriptionPackage->features()->attach($validatedData['features']);
        }

        return response()->json(['message' => 'Subscription package added successfully']);
    }

    public function edit($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        // Fetch all features from the Feature model
        $features = Feature::all();

        // Get selected feature IDs for the subscription package
        $selectedFeatures = $subscriptionPackage->features->pluck('id')->toArray();

        // Return the view with the subscriptionPackage, all features, and selected features for this package
        return view('admin.SubscriptionPackage.create', compact('subscriptionPackage', 'features', 'selectedFeatures'));
    }


    public function update(Request $request, SubscriptionPackage $package)
    {
        // Validate form data
        $validatedData = $request->validate([
            'package_name_en' => 'required|string|max:255',
            'package_name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'contact_limit' => 'required|integer|min:0',
            'features' => 'nullable|array', // Features can be null or an array of selected feature IDs
            'features.*' => 'exists:features,id', // Ensure the selected features exist
        ]);

        // Update the subscription package
        $package->update($validatedData);

        // Sync the selected features (removes existing features and adds the new ones)
        if (isset($validatedData['features'])) {
            $package->features()->sync($validatedData['features']);
        }

        return response()->json(['message' => 'Subscription package updated successfully']);
    }
    public function destroy($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $package = SubscriptionPackage::findOrFail($id);

        // Detach the related features (if any) before deleting the package
        $package->features()->detach();

        // Delete the subscription package
        $package->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Subscription package deleted successfully']);
    }
}
