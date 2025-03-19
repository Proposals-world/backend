<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CitiesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizationRequest;

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

    public function store(LocalizationRequest  $request)
    {
        City::create($request->validated());

        return response()->json(['message' => 'City added successfully']);
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('admin.city.create', compact('city', 'countries'));
    }

    public function update(LocalizationRequest $request, City $city)
    {

        $city->update($request->validated());

        return response()->json(['message' => 'City updated successfully']);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json(['message' => 'City deleted successfully']);
    }
}
