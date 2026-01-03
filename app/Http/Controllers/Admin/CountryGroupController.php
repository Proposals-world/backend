<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryGroupsDataTable;
use App\Http\Controllers\Controller;
use App\Models\CountryGroup;
use Illuminate\Http\Request;

class CountryGroupController extends Controller
{
    public function index(CountryGroupsDataTable $dataTable)
    {
        return $dataTable->render('admin.CountryGroups.index');
    }

    public function create()
    {
        return view('admin.CountryGroups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ]);

        CountryGroup::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Country group created successfully'
        ]);
    }

    public function edit(CountryGroup $countryGroup)
    {
        return view('admin.CountryGroups.create', compact('countryGroup'));
    }

    public function update(Request $request, CountryGroup $countryGroup)
    {
        $countryGroup->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Country group saved successfully'
        ]);
    }

    public function destroy($id)
    {
        CountryGroup::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
