<!-- resources/views/gifts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Gifts Store</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gifts as $gift)
                <tr>
                    <td>{{ $gift->name }}</td>
                    <td>{{ $gift->cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
