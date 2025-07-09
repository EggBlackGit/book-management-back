@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Add Book</h1>

    <form action="{{ route('books.store') }}" method="POST" class="space-y-4">
        @csrf
        @include('books.form')
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
        <a href="{{ route('books.index') }}" class="ml-4 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
