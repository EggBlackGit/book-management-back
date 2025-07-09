@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Edit Book</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        @include('books.form', ['book' => $book])
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
        <a href="{{ route('books.index') }}" class="ml-4 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
