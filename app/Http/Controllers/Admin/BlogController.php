<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(BlogsDataTable $dataTable)
    {
        return $dataTable->render('admin.blogs.index');
    }

    public function show()
    {
        
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required',
            'content_ar' => 'required',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
    
        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public'); // Saves to storage/app/public/blogs
        }
    
        $blog = Blog::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'slug' => Str::slug($request->title_en),
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'status' => $request->status,
            'image' => $imagePath, // Store image path
        ]);
    
        $blog->categories()->sync($request->categories);
    
        return redirect()->route('admin.blogs.index')->with('success', 'Blog added successfully');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required',
            'content_ar' => 'required',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->image = $imagePath;
        }
    
        $blog->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'slug' => Str::slug($request->title_en),
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'status' => $request->status,
        ]);
    
        $blog->categories()->sync($request->categories);
    
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}