@extends('layouts.app')
@section('title', 'Форма')
@section('content')
    <h1>Отправка данных</h1>
    @if (session('success')) <p style="color: green;">{{ session('success') }}</p> @endif
    @if ($errors->any())
        <ul style="color: red;">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    @endif
    <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <p><input type="text" name="name" placeholder="Имя" value="{{ old('name') }}"></p>
        <p><input type="email" name="email" placeholder="Email" value="{{ old('email') }}"></p>
        <p><textarea name="message" placeholder="Сообщение">{{ old('message') }}</textarea></p>
        <button type="submit">Отправить</button>
    </form>
@endsection
