<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NewsItem::with('author');

        // Search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by author
        if ($request->filled('author')) {
            $query->where('author_id', $request->author);
        }

        $newsItems = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('admin.news.index', compact('newsItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'required|date',
        ]);

        $validated['author_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        NewsItem::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('admin.news.edit', compact('newsItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newsItem = NewsItem::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'required|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($newsItem->image && Storage::disk('public')->exists($newsItem->image)) {
                Storage::disk('public')->delete($newsItem->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $newsItem->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        
        // Delete image if exists
        if ($newsItem->image && Storage::disk('public')->exists($newsItem->image)) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News item deleted successfully.');
    }
}
