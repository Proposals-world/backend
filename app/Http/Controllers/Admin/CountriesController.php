<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Country::create($request->all());

        return response()->json(['message' => 'Country added successfully']);
    }

    public function edit(Country $country)
    {
        return view('admin.countries.create', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $country->update($request->all());

        return response()->json(['message' => 'Country updated successfully']);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully']);
    }
}