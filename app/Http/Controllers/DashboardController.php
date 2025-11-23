<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        // Load relationships
        $user->load(['books', 'reviews', 'bookClubs']);
        
        // Calculate statistics
        $stats = [
            'books_read' => $user->books()->wherePivot('shelf', 'read')->count(),
            'currently_reading' => $user->books()->wherePivot('shelf', 'currently-reading')->count(),
            'want_to_read' => $user->books()->wherePivot('shelf', 'want-to-read')->count(),
            'total_books' => $user->books()->count(),
            'reviews_written' => $user->reviews()->count(),
            'book_clubs' => $user->bookClubs()->count(),
        ];
        
        // Get currently reading books with details
        $currentlyReading = $user->books()
            ->wherePivot('shelf', 'currently-reading')
            ->with(['genres', 'moods'])
            ->withPivot('current_page', 'started_at')
            ->take(6)
            ->get();
        
        // Get recently added books to shelves
        $recentBooks = $user->books()
            ->with(['genres', 'moods'])
            ->withPivot('shelf', 'created_at')
            ->orderByPivot('created_at', 'desc')
            ->take(6)
            ->get();
        
        return view('dashboard', compact('stats', 'currentlyReading', 'recentBooks'));
    }
}
