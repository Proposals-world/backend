<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\LocalizationRequest;
use App\Models\Country;
use App\Models\CountryGroup;
use Illuminate\Http\Request;


class CountriesController extends Controller
{
    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('admin.countries.index');
    }

    public function create()
    {
        $countryGroups = CountryGroup::all();
        return view('admin.countries.create', compact('countryGroups'));
    }
    public function store(CountryRequest   $request)
    {
        Country::create($request->validated());

        return redirect()->route('countries.index')->with('success', 'Country created successfully');
    }
    public function edit(Country $country)
    {
        $countryGroups = CountryGroup::all();
        return view('admin.countries.create', compact('country', 'countryGroups'));
    }

    public function update(CountryRequest   $request, Country $country)
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
