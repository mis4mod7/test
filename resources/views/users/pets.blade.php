@foreach ($pets as $pet)
    <div>
        <h3>{{ $pet->name }}</h3>
        <p>Price: {{ $pet->price }}</p>
    </div>
@endforeach
