@extends('layouts.app')

@section('title', 'Список всех постов')

@section('content')
    <h1>Все статьи</h1>

    <a href="{{ route('posts.create') }}" style="display:inline-block; margin-bottom: 20px;">Написать новую статью</a>

    @forelse ($posts as $post)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;">
            <h2>{{ $post->title }}</h2>
            <p><strong>Автор:</strong> {{ $post->author->name }}</p>
            <p>{{ $post->content }}</p>
        </div>
    @empty
        <p>Статей пока нет.</p>
    @endforelse
@endsection
