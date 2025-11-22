<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     */
    public function index(Request $request): View
    {
        $query = Book::with(['genres', 'moods']);

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by genre
        if ($request->filled('genre')) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        // Filter by mood
        if ($request->filled('mood')) {
            $query->whereHas('moods', function($q) use ($request) {
                $q->where('moods.id', $request->mood);
            });
        }

        $books = $query->orderBy('title')->paginate(12);

        return view('books.index', compact('books'));
    }

    /**
     * Display a single book with all details.
     */
    public function show(Book $book): View
    {
        // Eager load relationships
        $book->load(['genres', 'moods', 'reviews.user']);

        // Get user's shelf status for this book (if authenticated)
        $userShelf = null;
        if (auth()->check()) {
            $userShelf = $book->users()
                ->where('user_id', auth()->id())
                ->first()?->pivot;
        }

        return view('books.show', compact('book', 'userShelf'));
    }
}
