<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookClub;
use App\Models\Genre;
use App\Models\Mood;
use App\Models\NewsItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'books' => Book::count(),
            'book_clubs' => BookClub::count(),
            'news_items' => NewsItem::count(),
            'genres' => Genre::count(),
            'moods' => Mood::count(),
            'reviews' => Review::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
