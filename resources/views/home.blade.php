@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Your current balance is: {{Auth::user()->balance}} - You have {{Auth::user()->gifts}} Gifts - <br>
                        @foreach(Auth::user()->assets as $asset)
                        {{$asset->name}}

                    @endforeach
                    </div>

                    <h2>Your Pet</h2>
    @if (auth()->user()->pets)
        @foreach(auth()->user()->pets as $pet)
            <p>{{ $pet->name }}</p>
        @endforeach
    @else
        <p>You don't have a pet yet.</p>
        {{-- <form action="{{ route('pets.purchase', $pet) }}" method="POST">
            @csrf
            <button type="submit">Buy a Pet</button>
        </form> --}}
    @endif

    {{-- <h2>Feed Other Pets</h2>
    <p>Feed another user's pet and get rewards!</p>
    <form action="{{ route('pets.feed', $pet) }}" method="POST">
        @csrf
        <button type="submit">Feed a Pet</button>
    </form> --}}

                    

                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="friends-tab" data-toggle="tab" href="#friends-tab">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="chatrooms-tab" data-toggle="tab" href="Chatrooms">Chat Rooms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="others-tab" data-toggle="tab" href="Other">Others</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <!-- Friends Tab -->
                            <div class="tab-pane fade show active" id="friends-tab">
                                <h4>Friends</h4>
                                <ul class="list-group">
                                    @forelse ($friends as $friendship)
                                        <li class="list-group-item">{{ $friendship->friend->name }}</li>
                                    @empty
                                        <li class="list-group-item">No friends found.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <!-- Chat Rooms Tab -->
                            <div class="tab-pane fade" id="chatrooms-tab">
                                <h4>Chat Rooms</h4>
                                <ul class="list-group">
                                    @forelse ($chatrooms as $chatroom)
                                        <li class="list-group-item">
                                            <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->name }}</a>
                                        </li>
                                    @empty
                                        <li class="list-group-item">No chat rooms found.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="tab-pane" id="others-tab">
                                <h4>Chat Rooms</h4>
                                <ul class="list-group">
                                    @forelse ($chatrooms as $chatroom)
                                        <li class="list-group-item">
                                            <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->name }}</a>
                                        </li>
                                    @empty
                                        <li class="list-group-item">No chat rooms found.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
