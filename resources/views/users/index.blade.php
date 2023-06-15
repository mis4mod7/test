@foreach ($users as $user)
    <div>
        <h3>{{ $user->name }}</h3>
        <h4>Pets:</h4>
        <ul>
            @foreach ($user->pets as $pet)
                <li>{{ $pet->name }}</li>
                <form action="{{ route('pets.feed', $pet) }}" method="POST">
                    @csrf
                    <button type="submit">Feed</button>
                </form>
            @endforeach
        </ul>
    </div>
@endforeach

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
