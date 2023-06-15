<!-- assets/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Asset List</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->cost }}</td>
                    <td>
                        @if ($user->balance >= $asset->cost)
                            <form action="{{ route('assets.purchase', $asset) }}" method="POST">
                                @csrf
                                <button type="submit">Buy</button>
                            </form>
                        @else
                            Insufficient Balance
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
