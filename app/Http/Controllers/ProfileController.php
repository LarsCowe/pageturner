<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's public profile.
     */
    public function show(User $user): View
    {
        // Load relationships for statistics
        $user->load([
            'books' => function ($query) {
                $query->withPivot('shelf', 'finished_at');
            },
            'reviews',
            'bookClubs',
            'createdBookClubs'
        ]);

        // Calculate statistics
        $stats = [
            'books_read' => $user->books()->wherePivot('shelf', 'read')->count(),
            'currently_reading' => $user->books()->wherePivot('shelf', 'currently-reading')->count(),
            'want_to_read' => $user->books()->wherePivot('shelf', 'want-to-read')->count(),
            'reviews_written' => $user->reviews()->count(),
            'book_clubs' => $user->bookClubs()->count(),
        ];

        // Get shelves with books
        $shelves = [
            'currently_reading' => $user->books()
                ->wherePivot('shelf', 'currently-reading')
                ->with(['genres', 'moods'])
                ->take(6)
                ->get(),
            'read' => $user->books()
                ->wherePivot('shelf', 'read')
                ->with(['genres', 'moods'])
                ->take(6)
                ->get(),
            'want_to_read' => $user->books()
                ->wherePivot('shelf', 'want-to-read')
                ->with(['genres', 'moods'])
                ->take(6)
                ->get(),
        ];

        return view('profile.show', compact('user', 'stats', 'shelves'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $genres = Genre::orderBy('name')->get();
        
        return view('profile.edit', [
            'user' => $request->user(),
            'genres' => $genres,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update other fields
        $user->fill($request->except(['avatar', 'email']));
        
        // Handle email separately to trigger verification if changed
        if ($request->email !== $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
