<!-- resources/views/transfer.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Transfer Balance</h1>

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

    <form method="POST" action="{{ route('transfer.submit') }}">
        @csrf

        <div class="form-group">
            <label for="to_user_name">To User</label>
            <input type="text" class="form-control" id="to_user_name" name="to_user_name">
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" min="0">
        </div>

        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
@endsection
