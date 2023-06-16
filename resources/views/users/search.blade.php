@foreach ($users as $user)
    <div>
        <p>{{ $user->name }}</p>
        @if (!$user->isFriendWith(auth()->user()))
            @if ($user->hasFriendRequestFrom(auth()->user()))
                <p>Friend request received</p>
                <form action="{{ route('friend.acceptRequest', ['friendId' => $user->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Accept</button>
                </form>
            @else
                <form action="{{ route('friend.sendRequest', ['friendId' => $user->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Send Friend Request</button>
                </form>
            @endif
        @else
            <p>Already friends</p>
        @endif
    </div>
@endforeach
