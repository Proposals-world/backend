<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(BlogsDataTable $dataTable)
    {
        return $dataTable->render('admin.blogs.index');
    }

    public function show($id)
    {
        $locale = app()->getLocale(); // Detect the current locale

        $blog = Blog::with('categories')->findOrFail($id);

        // Format the blog details based on the locale
        $formattedBlog = [
            'title' => $locale === 'ar' ? $blog->title_ar : $blog->title_en,
            'slug' => $blog->slug,
            'content' => $locale === 'ar' ? $blog->content_ar : $blog->content_en,
            'image' => $blog->image ?  $blog->image : null, // Handle image path
            // 'views' => $blog->views,
            // 'status' => ucfirst($blog->status),
            // 'seo_title' => $locale === 'ar' ? $blog->seo_title_ar : $blog->seo_title_en,
            // 'seo_description' => $blog->seo_description,
            // 'seo_keywords' => $blog->seo_keywords,
            'categories' => $blog->categories->map(function ($category) use ($locale) {
                return [
                    'name' => $locale === 'ar' ? $category->name_ar : $category->name_en,
                    'slug' => $category->slug,
                ];
            }),
        ];
        // dd($formattedBlog);
        $otherBlogs = Blog::where('status', 'published')->where('id', '!=', $id)->get();
        $otherBlogs = $otherBlogs->random(min(3, $otherBlogs->count()))->map(function ($blog) use ($locale) {
            return [
                'id' => $blog->id,
                'title' => $locale === 'ar' ? $blog->title_ar : $blog->title_en,
                'slug' => $blog->slug,
                'image' => $blog->image ? $blog->image : null,
                'excerpt' => $locale === 'ar' ? Str::limit($blog->content_ar, 100) : Str::limit($blog->content_en, 100),
            ];
        });

        $previousBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextBlog = Blog::where('id', '>', $id)->orderBy('id')->first();

        if ($previousBlog) {
            $previousBlog = [
                'id' => $previousBlog->id,
                'title' => $locale === 'ar' ? $previousBlog->title_ar : $previousBlog->title_en,
                'slug' => $previousBlog->slug,
                'image' => $previousBlog->image ? $previousBlog->image : null,
            ];
        }

        if ($nextBlog) {
            $nextBlog = [
                'id' => $nextBlog->id,
                'title' => $locale === 'ar' ? $nextBlog->title_ar : $nextBlog->title_en,
                'slug' => $nextBlog->slug,
                'image' => $nextBlog->image ? $nextBlog->image : null,
            ];
        }
        // dD($nextBlog);
        return view('blog-details')->with([
            'formattedBlog' => $formattedBlog,
            'otherBlogs' => $otherBlogs,
            'previousBlog' => $previousBlog,
            'nextBlog' => $nextBlog
        ]);
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }



    public function store(BlogRequest $request)
    {
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        // Create blog
        $blog = Blog::create([
            'title_en'   => $request->title_en,
            'title_ar'   => $request->title_ar,
            'slug'       => Str::slug($request->title_en),
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'status'     => $request->status,
            'image'      => $imagePath,
        ]);

        // Sync categories
        $blog->categories()->sync($request->categories);

        return redirect()->route('blogs.index')->with('success', 'Blog added successfully');
    }


    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists (optional)
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->image = $imagePath;
        }

        // Update blog details
        $blog->update([
            'title_en'   => $request->title_en,
            'title_ar'   => $request->title_ar,
            'slug'       => Str::slug($request->title_en),
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'status'     => $request->status,
            'image'      => $blog->image, // Already handled above
        ]);

        // Sync categories
        $blog->categories()->sync($request->categories);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
