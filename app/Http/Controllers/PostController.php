<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of posts (admin).
     */
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,scheduled,published,unpublished',
            'published_at' => 'nullable|date',
        ]);

        // Auto-generate slug from title
        $validated['slug'] = Str::slug($validated['title']);

        $post = Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing a post.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,scheduled,published,unpublished',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    /**
     * Publish a post.
     */
    public function publish(Post $post)
    {
        $post->publish();

        return redirect()->back()
            ->with('success', 'Post published successfully!');
    }

    /**
     * Unpublish a post.
     */
    public function unpublish(Post $post)
    {
        $post->unpublish();

        return redirect()->back()
            ->with('success', 'Post unpublished successfully!');
    }

    /**
     * Display a single post (public).
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $comments = $post->comments()->approved()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Display published posts (public).
     */
    public function publicIndex()
    {
        $posts = Post::published()->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }
}
