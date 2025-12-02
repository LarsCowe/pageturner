<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Store a newly created review.
     */
    public function store(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:5000',
        ]);

        // Check if user already has a review for this book
        $existingReview = $book->reviews()->where('user_id', auth()->id())->first();
        
        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this book. You can edit your existing review.');
        }

        $book->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
        ]);

        return back()->with('success', 'Your review has been posted!');
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        // Ensure user owns this review
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:5000',
        ]);

        $review->update($validated);

        return back()->with('success', 'Your review has been updated!');
    }

    /**
     * Remove the specified review.
     */
    public function destroy(Review $review): RedirectResponse
    {
        // Ensure user owns this review or is admin
        if ($review->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review has been deleted.');
    }
}
