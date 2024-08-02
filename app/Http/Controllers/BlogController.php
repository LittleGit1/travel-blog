<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
            'slug' => ['required'],
            'body' => ['required'],
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'carousel_images.*' => 'image|mimes:jpeg,png,jpg|max:5120' // 5MB
        ]);

        $featuredImage = $request->file('featured_image');
        $featuredImageName = $featuredImage->getSize() . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug'  => $request->slug,
            'body'  => $request->body,
            'featured_image_path' => $featuredImageName,
        ]);

        $featuredImage->move(public_path('img/posts/featured'), $featuredImageName);

        if ($request->has('carousel_images')) {
            foreach ($request->file('carousel_images') as $key => $image) {
                $imageName = $image->getSize() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/posts/carousel'), $imageName);

                CarouselImage::create([
                    'post_id' => $post->id,
                    'public_path' => $imageName,
                ]);
            }
        }

        // Need to handle the post created
        return redirect('/account/posts')->with('success', 'Post created!');
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
                ])->count() === 1,
            "carouselImages"    => $post->carouselImages
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
        return view('blog.edit', ['post' => $post, "title" => "Edit post"]);
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
        if (!Auth::user()->id === $id)
            abort(401);

        $post->delete();
        //We need to delete the images that we have in the database.
        return redirect("/account/posts");
    }

    public function index_user(User $user)
    {
        return view('blog.index', [
            "posts" => Post::where('user_id', '=', $user->id)->paginate()
        ]);
    }
}
