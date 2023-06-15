@extends('layouts.app')

@section('content')
<div class="col-md-12 p-5">
    <div class="row">
        <div class="col-md-4">
@foreach ($pets as $pet)
    <div>
        <div class="asset">
            <div class="image-container">
                <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="rounded-image" style="height: 100px; width:100px;">
            </div>
            <p>{{ $pet->name }}</p>
        </div>
        <p>Price: {{ $pet->price }}</p>
        <form action="{{ route('pets.purchase', $pet) }}" method="POST">
            @csrf
            <button type="submit">Buy</button>
        </form>
    </div>
@endforeach
</div>
</div>
</div>

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
@endsection

