@extends('layouts.app')

@section('content')
    <html lang="en">

    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="card">
                <div class="card-header">Home Your current balance is: {{ Auth::user()->balance }} - You have
                    {{ Auth::user()->gifts }} Gifts - <br>

                    {{ Auth::user()->level }}

                    {{ Auth::user()->badge }}
                </div>
                @if (auth()->user()->assets()->count() > 0)
                    <div class="card-block">
                        @php
                            $assetsByName = Auth::user()->assets->groupBy('name');
                        @endphp
                        @foreach ($assetsByName as $name => $assets)
                            <div style="position: relative; display: inline-block;">
                                <img src="{{ asset('storage/' . $assets[0]->image) }}" alt="{{ $name }}"
                                     class="rounded-image" style="height: 100px; width:100px;">
                                <span
                                      style="position: absolute; top: 10px; right: 10px;
                                        background-color: #ff0000; color: #ffffff;
                                        padding: 5px; border-radius: 50%;">
                                    {{ $assets->count() }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>You don't have any assets</p>
                @endif


            </div>
            <h2>Dynamic Tabs</h2>


            <ul class="nav nav-tabs">
                <li class="active" data-active="#home"><a data-toggle="tab" href="#home">Home</a></li>
                <li data-active="#chatrooms"><a data-toggle="tab" href="#chatrooms">Chatrooms</a></li>
                <li data-active="#others"><a data-toggle="tab" href="#others">Other</a></li>
            </ul>


            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>HOME</h3>
                    @forelse (auth()->user()->getFriends() as $friendship)
                        <li class="list-group-item">{{ $friendship->name }}</li>
                    @empty
                        <li class="list-group-item">No friends found.</li>
                    @endforelse

                    <div class="row">
                        @if (auth()->user()->pets)
                            @foreach (auth()->user()->pets as $pet)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5>
                                                {{ $pet->name }}
                                            </h5>
                                        </div>
                                        <div class="card-block">
                                            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}"
                                                 class="rounded-image" style="height: 100px; width:100px;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>You don't have a pet yet.</p>
                        @endif
                    </div>
                </div>
                <div id="chatrooms" class="tab-pane fade">
                    <h3>Chatrooms</h3>
                    @forelse ($chatrooms as $chatroom)
                        <li class="list-group-item">
                            <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->name }}</a>
                        </li>
                    @empty
                        <li class="list-group-item">No chat rooms found.</li>
                    @endforelse
                </div>
                <div id="others" class="tab-pane fade">
                    <h3>Others</h3>
                    @forelse ($chatrooms as $chatroom)
                        <li class="list-group-item">
                            <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->name }}</a>
                        </li>
                    @empty
                        <li class="list-group-item">No others found.</li>
                    @endforelse
                </div>
            </div>
            


        </div>
    </body>

    </html>
@endsection
