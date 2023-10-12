<!-- resources/views/items/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    <p>Price: {{ $item->price }}</p>
    <p>Description: {{ $item->description }}</p>
    <!-- Add display for other attributes as needed -->
    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
