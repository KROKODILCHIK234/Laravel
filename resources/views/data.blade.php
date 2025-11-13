@extends('layouts.app')
@section('title', 'Данные')
@section('content')
    <h1>Сохраненные данные</h1>
    @forelse ($allData as $data)
        <table border="1" style="margin-bottom: 10px;">
            <tr><th>Имя</th><td>{{ $data['name'] }}</td></tr>
            <tr><th>Email</th><td>{{ $data['email'] }}</td></tr>
            <tr><th>Сообщение</th><td>{{ $data['message'] }}</td></tr>
        </table>
    @empty
        <p>Данных пока нет.</p>
    @endforelse
@endsection
