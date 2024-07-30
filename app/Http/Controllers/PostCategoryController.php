<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blog-categories.index', [
            'title' => "Manage Categories",
            'categories' => PostCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-categories.create', [
            'title' => "Create Post "
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug'  => ['required']
        ]);

        if (PostCategory::where([
            ['title', '=', $request->title],
            ['slug', '=', $request->slug]
        ])->count() > 0) {
            return back()->withInput([
                'title' => $request->title,
                'slug'  => $request->slug,
            ])->withErrors(
                ['exists' => 'Category already exists.']
            );
        }

        PostCategory::factory()->create([
            'title' => $request->title,
            'slug'  => $request->slug
        ]);

        return redirect('/admin/blog/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($postCategory)
    {
        //Diagnose route model binding

        $category = PostCategory::where('slug', '=', $postCategory)->first();

        if (!$category) return abort(404);

        return view('admin.blog-categories.edit', [
            "title"     => "Edit Category",
            "category"  => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $postCategory)
    {
        $request->validate([
            'title' => ['required'],
            'slug'  => ['required']
        ]);

        $category = PostCategory::where('id', '=', $postCategory);

        if(!$category) return abort(404);

        PostCategory::where('slug', '=', $postCategory)->update([
            'title' => $request->title,
            'slug'  => $request->slug
        ]);

        return redirect('/admin/blog/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        //
    }
}
