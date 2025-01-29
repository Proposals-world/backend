<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.city.index');
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.city.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        City::create($request->all());

        return response()->json(['message' => 'City added successfully']);
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('admin.city.create', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $city->update($request->all());

        return response()->json(['message' => 'City updated successfully']);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json(['message' => 'City deleted successfully']);
    }
}
