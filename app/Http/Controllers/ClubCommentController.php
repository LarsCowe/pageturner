<?php

namespace App\Http\Controllers;

use App\Models\ClubPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubCommentController extends Controller
{
    public function store(Request $request, ClubPost $post)
    {
        $bookClub = $post->bookClub;

        if (!$bookClub->members()->where('user_id', Auth::id())->exists()) {
            abort(403, 'You must be a member to comment.');
        }

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
