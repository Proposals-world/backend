<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriptionPackagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionPackageRequest;
use App\Services\FintesaPaymentService;

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

    public function store(SubscriptionPackageRequest $request, FintesaPaymentService $paymentService)
    {
        $package = SubscriptionPackage::create($request->validated());

        // Sync with Fintesa
        $create = $paymentService->createProduct($package);
        if ($create['ok'] ?? false) {
            $package->fintesa_product_id = $create['product_id'] ?? null;
            $package->fintesa_price_id = $create['price_id'] ?? null;
            if (!empty($create['payment_url'])) {
                $package->payment_url = $create['payment_url'];
            }
            $package->save();
        }

        return response()->json(['message' => 'Subscription package added successfully']);
    }

    public function edit($id)
    {
        // Fetch the SubscriptionPackage by its ID
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);


        // Return the view with the subscriptionPackage, all features, and selected features for this package
        return view('admin.SubscriptionPackage.create', compact('subscriptionPackage'));
    }


    public function update(SubscriptionPackageRequest $request, $id, FintesaPaymentService $paymentService)
    {
        // dd($request->all());
        // Find the package first
        $package = SubscriptionPackage::findOrFail($id);

        // Update the subscription package (gender/is_one_time)
        $validated = $request->validated();
        $package->update($validated);

        // Re-sync product price if needed
        if ($package->fintesa_product_id) {
            // Re-create product on update to ensure it's up-to-date in Fintesa
            $create = $paymentService->createProduct($package);
            if ($create['ok'] ?? false) {
                $package->fintesa_product_id = $create['product_id'] ?? $package->fintesa_product_id;
                $package->fintesa_price_id = $create['price_id'] ?? $package->fintesa_price_id;
                if (!empty($create['payment_url'])) {
                    $package->payment_url = $create['payment_url'];
                }
                $package->save();
            }
        }

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
