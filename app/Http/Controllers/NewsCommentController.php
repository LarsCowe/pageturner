<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsCommentController extends Controller
{
    public function store(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $newsItem->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
