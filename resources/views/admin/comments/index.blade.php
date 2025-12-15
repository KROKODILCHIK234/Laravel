@extends('layouts.app')

@section('title', 'Moderate Comments')

@section('content')
    <h2 style="margin-bottom: 20px;">💬 Moderate Comments</h2>

    @if($comments->count() > 0)
        @foreach($comments as $comment)
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                    <div>
                        <h4 style="margin-bottom: 5px;">{{ $comment->author_name }}
                            <span
                                style="font-weight: normal; color: #7f8c8d; font-size: 14px;">({{ $comment->author_email }})</span>
                        </h4>
                        <p style="color: #7f8c8d; font-size: 13px;">
                            On post: <a href="{{ route('posts.show', $comment->post->slug) }}"
                                target="_blank">{{ $comment->post->title }}</a>
                            <br>{{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <span class="badge badge-{{ $comment->status }}">{{ ucfirst($comment->status) }}</span>
                </div>

                <p style="background: #f8f9fa; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
                    {{ $comment->content }}
                </p>

                @if($comment->status === 'pending')
                    <div class="actions">
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">✓ Approve</button>
                        </form>
                        <form action="{{ route('admin.comments.reject', $comment) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">✗ Reject</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach

        <div style="margin-top: 20px;">
            {{ $comments->links() }}
        </div>
    @else
        <div class="card">
            <p style="text-align: center; color: #7f8c8d;">No pending comments to moderate.</p>
        </div>
    @endif
@endsection