<?php

namespace App\Http\Controllers;

use App\Models\BookClub;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookClubController extends Controller
{
    /**
     * Display a listing of all book clubs.
     */
    public function index(): View
    {
        $bookClubs = BookClub::withCount('members')
            ->with('creator')
            ->orderBy('name')
            ->paginate(12);

        // Get user's memberships if authenticated
        $userClubIds = [];
        if (auth()->check()) {
            $userClubIds = auth()->user()->bookClubs()->pluck('book_clubs.id')->toArray();
        }

        return view('book-clubs.index', compact('bookClubs', 'userClubIds'));
    }

    /**
     * Display a single book club with details.
     */
    public function show(BookClub $bookClub): View
    {
        $bookClub->load(['creator', 'members']);
        
        $isMember = auth()->check() && $bookClub->members->contains(auth()->id());
        $userRole = null;
        
        if ($isMember) {
            $userRole = $bookClub->members->find(auth()->id())->pivot->role;
        }

        return view('book-clubs.show', compact('bookClub', 'isMember', 'userRole'));
    }

    /**
     * Show the form for creating a new book club.
     */
    public function create(): View
    {
        return view('book-clubs.create');
    }

    /**
     * Store a new book club.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $bookClub = BookClub::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'creator_id' => auth()->id(),
        ]);

        // Automatically add creator as moderator member
        $bookClub->members()->attach(auth()->id(), ['role' => 'moderator']);

        return redirect()->route('book-clubs.show', $bookClub)->with('success', 'Book club created successfully!');
    }

    /**
     * Join a book club.
     */
    public function join(BookClub $bookClub): RedirectResponse
    {
        $userId = auth()->id();

        // Check if already a member
        if ($bookClub->members->contains($userId)) {
            return redirect()->back()->with('error', 'You are already a member of this book club.');
        }

        $bookClub->members()->attach($userId, ['role' => 'member']);

        return redirect()->back()->with('success', 'Welcome to ' . $bookClub->name . '!');
    }

    /**
     * Leave a book club.
     */
    public function leave(BookClub $bookClub): RedirectResponse
    {
        $userId = auth()->id();

        // Check if member
        if (!$bookClub->members->contains($userId)) {
            return redirect()->back()->with('error', 'You are not a member of this book club.');
        }

        // Creator cannot leave (they should delete the club instead)
        if ($bookClub->creator_id === $userId) {
            return redirect()->back()->with('error', 'As the creator, you cannot leave this book club. You may delete it instead.');
        }

        $bookClub->members()->detach($userId);

        return redirect()->route('book-clubs.index')->with('success', 'You have left ' . $bookClub->name . '.');
    }

    /**
     * Show the form for editing a book club.
     */
    public function edit(BookClub $bookClub): View
    {
        // Only creator can edit
        if ($bookClub->creator_id !== auth()->id()) {
            abort(403, 'Only the creator can edit this book club.');
        }

        return view('book-clubs.edit', compact('bookClub'));
    }

    /**
     * Update a book club.
     */
    public function update(Request $request, BookClub $bookClub): RedirectResponse
    {
        // Only creator can update
        if ($bookClub->creator_id !== auth()->id()) {
            abort(403, 'Only the creator can update this book club.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $bookClub->update($validated);

        return redirect()->route('book-clubs.show', $bookClub)->with('success', 'Book club updated successfully!');
    }

    /**
     * Delete a book club.
     */
    public function destroy(BookClub $bookClub): RedirectResponse
    {
        // Only creator can delete
        if ($bookClub->creator_id !== auth()->id()) {
            abort(403, 'Only the creator can delete this book club.');
        }

        $clubName = $bookClub->name;
        $bookClub->delete();

        return redirect()->route('book-clubs.index')->with('success', $clubName . ' has been deleted.');
    }
}
