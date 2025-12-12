<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookClub;
use App\Models\Mood;
use App\Models\NewsItem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View|RedirectResponse
    {
        // Redirect authenticated users to dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        // Featured books (latest with cover images, or just latest)
        $featuredBooks = Book::query()
            ->whereNotNull('cover_image')
            ->latest()
            ->take(6)
            ->get();
        
        // If not enough books with covers, fill with any books
        if ($featuredBooks->count() < 6) {
            $featuredBooks = Book::latest()->take(6)->get();
        }

        // Popular book clubs (by member count)
        $popularClubs = BookClub::query()
            ->withCount('members')
            ->where('is_private', false)
            ->orderByDesc('members_count')
            ->take(3)
            ->get();

        // Latest news items
        $latestNews = NewsItem::query()
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        // Featured moods for discovery
        $featuredMoods = Mood::take(8)->get();

        // Platform statistics
        $stats = [
            'books' => Book::count(),
            'users' => User::count(),
            'clubs' => BookClub::count(),
        ];

        return view('home', compact(
            'featuredBooks',
            'popularClubs',
            'latestNews',
            'featuredMoods',
            'stats'
        ));
    }
}
