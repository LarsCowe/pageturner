<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = FaqCategory::withCount('faqItems')
            ->orderBy('order')
            ->get();

        return view('admin.faq.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name',
        ]);

        // Auto-generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Set order to last position
        $validated['order'] = FaqCategory::max('order') + 1;

        FaqCategory::create($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = FaqCategory::findOrFail($id);
        return view('admin.faq.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = FaqCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name,' . $id,
        ]);

        // Auto-generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category deleted successfully.');
    }
}
