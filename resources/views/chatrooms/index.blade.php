@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chat Rooms</h1>

        <ul>
            @foreach ($chatrooms as $chatroom)
                <li>{{ $chatroom->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
