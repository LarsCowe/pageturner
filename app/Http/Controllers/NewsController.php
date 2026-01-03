<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news items.
     */
    public function index()
    {
        $newsItems = NewsItem::with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('news.index', compact('newsItems'));
    }

    /**
     * Display the specified news item.
     */
    public function show(NewsItem $newsItem)
    {
        $newsItem->load(['author', 'comments.user']);
        
        return view('news.show', compact('newsItem'));
    }
}
