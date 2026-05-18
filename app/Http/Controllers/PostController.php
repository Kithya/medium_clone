<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $posts = Post::with(['user', 'media', 'category'])
            ->withCount('claps')
            ->latest()
            ->paginate(8);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        unset($data['image']);

        $post = Post::create($data);
        $media = $post->addMediaFromRequest('image')
            ->preservingOriginal()
            ->toMediaCollection('default', 'public');
        $post->forceFill(['image' => $media->getPathRelativeToRoot()])->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        $post->loadMissing(['user', 'media', 'category'])->loadCount('claps');

        if ($post->user->username !== $username) {
            abort(404);
        }

        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->loadMissing(['user', 'media', 'category']);
        $categories = Category::get();

        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validated();
        unset($data['image']);

        $post->update($data);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection();

            $media = $post->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('default', 'public');

            $post->forceFill(['image' => $media->getPathRelativeToRoot()])->save();
        }

        return redirect()->route('myPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $post->delete();

        return redirect()->route('dashboard');
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->with(['user', 'media', 'category'])
            ->withCount('claps')
            ->latest()
            ->paginate(8);

        return view('post.index', ['posts' => $posts]);
    }

    public function myPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()
            ->with(['user', 'media', 'category'])
            ->withCount('claps')
            ->latest()
            ->paginate(8);

        return view('post.index', ['posts' => $posts]);
    }
}
