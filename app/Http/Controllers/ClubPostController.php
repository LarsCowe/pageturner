<?php

namespace App\Http\Controllers;

use App\Models\BookClub;
use App\Models\ClubPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubPostController extends Controller
{
    public function show(BookClub $bookClub, ClubPost $post)
    {
        if ($post->book_club_id !== $bookClub->id) {
            abort(404);
        }

        if (!$bookClub->members()->where('user_id', Auth::id())->exists()) {
            abort(403, 'You must be a member to view discussions.');
        }

        $post->load(['user', 'comments.user']);

        return view('book-clubs.posts.show', compact('bookClub', 'post'));
    }

    public function store(Request $request, BookClub $bookClub)
    {
        if (!$bookClub->members()->where('user_id', Auth::id())->exists()) {
            abort(403, 'You must be a member to post.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $bookClub->posts()->create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Discussion started successfully.');
    }
}
