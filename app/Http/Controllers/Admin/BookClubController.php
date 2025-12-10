<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookClub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookClubController extends Controller
{
    /**
     * Display a listing of book clubs.
     */
    public function index(Request $request): View
    {
        // Validate search input
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $query = BookClub::query()
            ->with('creator')
            ->withCount('members');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('creator', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $bookClubs = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.book-clubs.index', compact('bookClubs'));
    }

    /**
     * Show the form for creating a new book club.
     */
    public function create(): View
    {
        $users = User::orderBy('name')->get();

        return view('admin.book-clubs.create', compact('users'));
    }

    /**
     * Store a newly created book club.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'creator_id' => 'required|exists:users,id',
            'is_private' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('book-clubs', 'public');
        }

        $bookClub = BookClub::create($validated);

        // Automatically add creator as moderator
        $bookClub->members()->attach($validated['creator_id'], [
            'role' => 'moderator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.book-clubs.index')
            ->with('success', 'Book club succesvol aangemaakt!');
    }

    /**
     * Show the form for editing a book club.
     */
    public function edit(BookClub $bookClub): View
    {
        $bookClub->load('creator');
        $users = User::orderBy('name')->get();

        return view('admin.book-clubs.edit', compact('bookClub', 'users'));
    }

    /**
     * Update the specified book club.
     */
    public function update(Request $request, BookClub $bookClub): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'creator_id' => 'required|exists:users,id',
            'is_private' => 'boolean',
        ]);

        $oldCreatorId = $bookClub->creator_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($bookClub->image && Storage::disk('public')->exists($bookClub->image)) {
                Storage::disk('public')->delete($bookClub->image);
            }
            $validated['image'] = $request->file('image')->store('book-clubs', 'public');
        }

        $bookClub->update($validated);

        // If creator changed, update members table
        if ($oldCreatorId != $validated['creator_id']) {
            // Remove old creator as moderator (downgrade to member if they joined)
            if ($bookClub->members()->where('user_id', $oldCreatorId)->exists()) {
                $bookClub->members()->updateExistingPivot($oldCreatorId, ['role' => 'member']);
            }
            
            // Add new creator as moderator (or update if already member)
            if ($bookClub->members()->where('user_id', $validated['creator_id'])->exists()) {
                $bookClub->members()->updateExistingPivot($validated['creator_id'], ['role' => 'moderator']);
            } else {
                $bookClub->members()->attach($validated['creator_id'], [
                    'role' => 'moderator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.book-clubs.index')
            ->with('success', 'Book club succesvol bijgewerkt!');
    }

    /**
     * Remove the specified book club.
     */
    public function destroy(BookClub $bookClub): RedirectResponse
    {
        // Model's booted method handles image deletion and member detachment
        $bookClub->delete();

        return redirect()->route('admin.book-clubs.index')
            ->with('success', 'Book club succesvol verwijderd!');
    }
}
