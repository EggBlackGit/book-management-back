<div>
    <label class="block mb-1">Title</label>
    <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title', $book->title ?? '') }}" required>
</div>
<div>
    <label class="block mb-1">Author</label>
    <input type="text" name="author" class="w-full border p-2 rounded" value="{{ old('author', $book->author ?? '') }}" required>
</div>
<div>
    <label class="block mb-1">Published Year</label>
    <input type="number" name="published_year" class="w-full border p-2 rounded" value="{{ old('published_year', $book->published_year ?? '') }}">
</div>
<div>
    <label class="block mb-1">Genre</label>
    <input type="text" name="genre" class="w-full border p-2 rounded" value="{{ old('genre', $book->genre ?? '') }}">
</div>
