@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <h2 style="margin-bottom: 20px;">📰 Latest Posts</h2>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="card">
                <h3 style="margin-bottom: 10px;">
                    <a href="{{ route('posts.show', $post->slug) }}" style="color: #2c3e50; text-decoration: none;">
                        {{ $post->title }}
                    </a>
                </h3>
                <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 15px;">
                    Published {{ $post->published_at?->diffForHumans() ?? 'recently' }}
                </p>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 200) }}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary" style="margin-top: 15px;">
                    Read More →
                </a>
            </div>
        @endforeach

        <div style="margin-top: 30px;">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card">
            <p style="text-align: center; color: #7f8c8d;">No posts published yet. Check back soon!</p>
        </div>
    @endif
@endsection