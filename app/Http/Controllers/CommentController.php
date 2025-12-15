<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'author_name' => 'required|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required',
        ]);

        $validated['post_id'] = $post->id;
        $validated['status'] = 'pending';

        Comment::create($validated);

        return redirect()->back()
            ->with('success', 'Your comment has been submitted and is awaiting moderation.');
    }

    /**
     * Display pending comments for moderation (admin).
     */
    public function index()
    {
        $comments = Comment::pending()
            ->with('post')
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Approve a comment.
     */
    public function approve(Comment $comment)
    {
        $comment->approve();

        return redirect()->back()
            ->with('success', 'Comment approved!');
    }

    /**
     * Reject a comment.
     */
    public function reject(Comment $comment)
    {
        $comment->reject();

        return redirect()->back()
            ->with('success', 'Comment rejected!');
    }
}
