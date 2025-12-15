@extends('layouts.app')

@section('title', 'Manage Posts')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>📝 Manage Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ New Post</a>
    </div>

    @if($posts->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><strong>{{ $post->title }}</strong></td>
                        <td>
                            <span class="badge badge-{{ $post->status }}">{{ ucfirst($post->status) }}</span>
                        </td>
                        <td>{{ $post->published_at?->format('M j, Y H:i') ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                                @if($post->status !== 'published')
                                    <form action="{{ route('admin.posts.publish', $post) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Publish</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.posts.unpublish', $post) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Unpublish</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: inline;"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card">
            <p style="text-align: center; color: #7f8c8d;">No posts yet. Create your first post!</p>
        </div>
    @endif
@endsection