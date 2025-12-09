<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index(Request $request): View
    {
        // Validate search input
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $query = Book::query()->withCount('reviews');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        $books = $query->orderBy('title')->paginate(20);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        $genres = Genre::orderBy('name')->get();
        $moods = Mood::orderBy('name')->get();

        return view('admin.books.create', compact('genres', 'moods'));
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn', 'regex:/^(?:\d{9}[\dX]|\d{13})$/'],
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date|before_or_equal:today',
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'moods' => 'nullable|array',
            'moods.*' => 'exists:moods,id',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book = Book::create($validated);

        // Attach genres and moods
        if ($request->filled('genres')) {
            $book->genres()->attach($request->genres);
        }

        if ($request->filled('moods')) {
            $book->moods()->attach($request->moods);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Boek succesvol aangemaakt!');
    }

    /**
     * Show the form for editing a book.
     */
    public function edit(Book $book): View
    {
        $book->load(['genres', 'moods']);
        $genres = Genre::orderBy('name')->get();
        $moods = Mood::orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'genres', 'moods'));
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn,' . $book->id, 'regex:/^(?:\d{9}[\dX]|\d{13})$/'],
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date|before_or_equal:today',
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'moods' => 'nullable|array',
            'moods.*' => 'exists:moods,id',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($validated);

        // Sync genres and moods
        $book->genres()->sync($request->genres ?? []);
        $book->moods()->sync($request->moods ?? []);

        return redirect()->route('admin.books.index')
            ->with('success', 'Boek succesvol bijgewerkt!');
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book): RedirectResponse
    {
        // All cascade deletes and image cleanup handled by model's booted method
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Boek succesvol verwijderd!');
    }
}
