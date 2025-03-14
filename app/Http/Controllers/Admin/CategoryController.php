<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }
    public function show(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:categories,name_en',
            'name_ar' => 'required|string|max:255',
        ]);

        // Generate slug dynamically from name_en
        $validatedData = $request->all();
        $validatedData['slug'] = Str::slug($validatedData['name_en']);

        Category::create($validatedData);

        return response()->json(['message' => 'Specialization added successfully']);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:categories,name_en,' . $category->id,
            'name_ar' => 'required|string|max:255',
        ]);

        // Generate slug dynamically from name_en
        $validatedData = $request->all();
        $validatedData['slug'] = Str::slug($validatedData['name_en']);

        $category->update($validatedData);

        return response()->json(['message' => 'Category updated successfully']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}