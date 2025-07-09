<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        Log::info('Fetching books list');
        $books = Book::orderBy('created_at', 'desc')->paginate(2);
        return $books;
    }

    public function store(Request $request)
    {
        Log::info('Creating a new book', ['data' => $request->all()]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'nullable|integer',
            'genre' => 'nullable|string|max:100',
        ]);

        $create = Book::create($validated);

        Log::info('Book created successfully', ['book' => $create]);

        return $create;
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'nullable|integer',
            'genre' => 'nullable|string|max:100',
        ]);

        $original = $book->getOriginal();

        $book->update($validated);

        $changes = [];
        foreach ($validated as $key => $newValue) {
            $oldValue = $original[$key] ?? null;
            if ($oldValue != $newValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }

        Log::info('✏️ [BookController@update] Book updated with changes', [
            'book_id' => $book->id,
            'changes' => $changes
        ]);

        return $book;
    }


    public function destroy(Book $book)
    {
        Log::warning('Deleting book', ['book_id' => $book->id]);

        $delete = $book->delete();

        Log::info('Book deleted', ['book_id' => $book->id]);

        return $delete;
    }
}

