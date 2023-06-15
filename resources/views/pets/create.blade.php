@extends('layouts.app')

<form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="age">Price:</label>
        <input type="number" name="price" id="price" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Create Pet</button>
</form>
