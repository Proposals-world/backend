<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalizationRequest;
use App\Models\Country;
use Illuminate\Http\Request;


class CountriesController extends Controller
{
    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('admin.countries.index');
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(LocalizationRequest  $request)
    {
        Country::create($request->validated());

        return redirect()->route('countries.index')->with('success', 'Country created successfully');
    }
    public function edit(Country $country)
    {
        return view('admin.countries.create', compact('country'));
    }

    public function update(LocalizationRequest  $request, Country $country)
    {

        $country->update($request->validated());

        return response()->json(['message' => 'Country updated successfully']);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully']);
    }
}
