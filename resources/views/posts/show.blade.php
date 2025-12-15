@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="card" style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; margin-bottom: 15px;">{{ $post->title }}</h1>
        <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 20px;">
            Published {{ $post->published_at?->format('F j, Y') }}
        </p>
        <div style="line-height: 1.8;">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <div class="card">
        <h3 style="margin-bottom: 20px;">💬 Comments ({{ $comments->count() }})</h3>

        @foreach($comments as $comment)
            <div style="border-left: 3px solid #3498db; padding-left: 15px; margin-bottom: 20px;">
                <p style="font-weight: 600; margin-bottom: 5px;">{{ $comment->author_name }}</p>
                <p style="color: #7f8c8d; font-size: 13px; margin-bottom: 10px;">
                    {{ $comment->created_at->diffForHumans() }}
                </p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">

        <h4 style="margin-bottom: 15px;">Leave a Comment</h4>
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="author_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="author_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}" class="btn btn-primary">← Back to Posts</a>
    </div>
@endsection