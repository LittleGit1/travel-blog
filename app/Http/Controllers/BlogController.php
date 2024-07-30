<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('blog.index', ["posts" => Post::with('user')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('blog.create', ["title" => "Create Blog Post"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'body' => ['required']
        ]);

        $newPost = new Post;

        $newPost->title = $request->title;
        $newPost->slug = "slug";
        $newPost->body = $request->body;
        $newPost->user_id = Auth()->user()->id;

        $result = $newPost->save();

        if (!$result) return back()->withInput([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->slug
        ]);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        $isGuest = Auth()->guest();

        return view('blog.show', [
            "title" => $post->title,
            "post" => $post,
            "likes" => $post->likes->count(),
            "userLiked" => !$isGuest && PostLike::where([
                    ['user_id', '=', Auth()->user()->id],
                    ['post_id', '=', $post->id]
                ])->count() === 1
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth()->user()->id !== $post->user->id) {
            return abort(401);
        }
        return view('blog.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'body' => ['required'],
        ]);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        $result = $post->save();

        if (!$result) return back()->withInput([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body
        ]);

        return redirect("blog/posts/$post->slug");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = $post->user->id;
        if (!Auth()->user()->id === $id)
            return abort(401);

        $post->delete();
        return redirect("/users/$id/posts");
    }

    public function index_user(User $user)
    {
        return view('blog.index', [
            "posts" => Post::where('user_id', '=', $user->id)->paginate()
        ]);
    }
}
