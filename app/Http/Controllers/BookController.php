<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
                // Support both ID and slug
                if (is_numeric($request->genre)) {
                    $q->where('genres.id', $request->genre);
                } else {
                    $q->where('genres.slug', $request->genre);
                }
            });
        }

        // Filter by mood
        if ($request->filled('mood')) {
            $query->whereHas('moods', function($q) use ($request) {
                // Support both ID and slug
                if (is_numeric($request->mood)) {
                    $q->where('moods.id', $request->mood);
                } else {
                    $q->where('moods.slug', $request->mood);
                }
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

    /**
     * Add a book to user's shelf.
     */
    public function addToShelf(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'shelf' => 'required|in:currently-reading,want-to-read,read'
        ]);

        $userId = auth()->id();

        // Check if book is already on a shelf
        $existingShelf = $book->users()->where('user_id', $userId)->first();
        
        if ($existingShelf) {
            return redirect()->back()->with('error', 'Book is already on your shelf.');
        }

        // Add to shelf
        $book->users()->attach($userId, [
            'shelf' => $validated['shelf'],
            'started_at' => $validated['shelf'] === 'currently-reading' ? now() : null,
            'finished_at' => $validated['shelf'] === 'read' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Book added to ' . ucwords(str_replace('-', ' ', $validated['shelf'])) . '!');
    }

    /**
     * Update shelf or move book to different shelf.
     */
    public function updateShelf(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'shelf' => 'required|in:currently-reading,want-to-read,read',
            'current_page' => 'nullable|integer|min:0|max:' . ($book->pages ?? 99999)
        ]);

        $userId = auth()->id();

        // Check if book exists on shelf
        $userBook = $book->users()->where('user_id', $userId)->first();
        
        if (!$userBook) {
            return redirect()->back()->with('error', 'Book not found on your shelf.');
        }

        $updateData = ['shelf' => $validated['shelf']];
        $pagesRead = 0;

        // Handle shelf-specific timestamps
        if ($validated['shelf'] === 'currently-reading' && $userBook->pivot->shelf !== 'currently-reading') {
            $updateData['started_at'] = now();
        }
        
        if ($validated['shelf'] === 'read' && $userBook->pivot->shelf !== 'read') {
            $updateData['finished_at'] = now();
        }

        // Update current_page if provided and calculate pages read
        if (isset($validated['current_page'])) {
            $oldPage = $userBook->pivot->current_page ?? 0;
            $newPage = $validated['current_page'];
            
            // Only count positive progress (no negative pages if user goes back)
            if ($newPage > $oldPage) {
                $pagesRead = $newPage - $oldPage;
            }
            
            $updateData['current_page'] = $newPage;
        }

        $book->users()->updateExistingPivot($userId, $updateData);

        // Log reading activity for today with pages read
        auth()->user()->logReadingActivity($pagesRead);

        $message = 'Shelf updated successfully!';
        if ($pagesRead > 0) {
            $message .= " You read {$pagesRead} pages today! 🎉";
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove a book from user's shelf.
     */
    public function removeFromShelf(Book $book): RedirectResponse
    {
        $userId = auth()->id();

        $book->users()->detach($userId);

        return redirect()->back()->with('success', 'Book removed from your shelf.');
    }
}
