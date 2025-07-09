@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Book List</h1>
        <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Book</a>
    </div>

    {{-- <table class="w-full border rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Title</th>
                <th class="p-2 text-left">Author</th>
                <th class="p-2 text-left">Year</th>
                <th class="p-2 text-left">Genre</th>
                <th class="p-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="border-b">
                    <td class="p-2">{{ $book->title }}</td>
                    <td class="p-2">{{ $book->author }}</td>
                    <td class="p-2">{{ $book->published_year }}</td>
                    <td class="p-2">{{ $book->genre }}</td>
                    <td class="p-2">
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-sm font-medium">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Author</th>
                    <th class="px-6 py-3 text-left">Year</th>
                    <th class="px-6 py-3 text-left">Genre</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach ($books as $book)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->published_year }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->genre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="mt-4">
            {{ $books->links() }}
        </div> --}}
        
       @if ($books->hasPages())
            <div class="mt-6">
                <div class="bg-white p-4 rounded shadow">
                    {{ $books->links() }}
                </div>
            </div>
        @endif

        {{-- @if ($books->hasPages())
            <div class="mt-6">
                <div class="inline-flex bg-white px-4 py-2 shadow rounded-md">
                    {{ $books->onEachSide(1)->links() }}
                </div>
            </div>
        @endif --}}
    </div>
</div>
@endsection
