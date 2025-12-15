@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2 style="margin-bottom: 20px;">✏️ Edit Post</h2>

    <div class="card">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                @error('title')<p style="color: #e74c3c; font-size: 14px; margin-top: 5px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                @error('content')<p style="color: #e74c3c; font-size: 14px; margin-top: 5px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published
                    </option>
                    <option value="scheduled" {{ old('status', $post->status) == 'scheduled' ? 'selected' : '' }}>Scheduled
                    </option>
                    <option value="unpublished" {{ old('status', $post->status) == 'unpublished' ? 'selected' : '' }}>
                        Unpublished</option>
                </select>
            </div>

            <div class="form-group">
                <label>Publish At</label>
                <input type="datetime-local" name="published_at" class="form-control"
                    value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                @error('published_at')<p style="color: #e74c3c; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-success">Update Post</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>
@endsection