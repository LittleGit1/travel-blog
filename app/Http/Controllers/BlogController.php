<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\CarouselImage;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->query('category')) {
            return view('blog.index', [
                "posts" => Post::with('user')
                    ->whereHas('categories', function ($query) use ($request) {
                        $query->where('slug', '=', $request->query('category'));
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(9)
            ]);
        }
        return view('blog.index', ["posts" => Post::with('user')->orderBy('created_at', 'DESC')->paginate(9)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('blog.create', [
            "title" => "Create Blog Post",
            "categories"  => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'carousel_images.*' => 'image|mimes:jpeg,png,jpg|max:5120' // 5MB
        ]);

        $featuredImage = $request->file('featured_image');
        $featuredImageName = $featuredImage->getSize() . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug'  => $request->slug,
            'body'  => $request->content,
            'featured_image_path' => $featuredImageName,
        ]);

        if ($request->has('categories')) {
            $categories = [];
            foreach ($request->get('categories') as $categoryId) {
                $categories[] = [
                    'post_id' => $post->id,
                    'category_id'  => $categoryId
                ];
            }
            DB::table('post_categories')->insert($categories);
        }

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
            "categories" => $post->categories()->get(),
            "hasFeaturedImage" => $post->featured_image_path,
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
    public function edit(Post $post, Request $request)
    {
        if ($request->user()->cannot('edit', $post)) {
            return abort(401);
        }

        return view('blog.edit', ['post' => $post, "title" => "Edit post"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        if ($request->user()->cannot('edit', $post)) {
            return abort(401);
        }

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
    public function destroy(Post $post, Request $request)
    {

        if ($request->user()->cannot('destroy', $post)) {
            return abort(401);
        }

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
