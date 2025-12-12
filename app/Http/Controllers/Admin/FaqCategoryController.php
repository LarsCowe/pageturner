<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = FaqCategory::withCount('faqItems')
            ->orderBy('order')
            ->get();

        return view('admin.faq.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.faq.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name',
        ], [
            'name.required' => 'The category name is required.',
            'name.max' => 'The category name must not exceed 255 characters.',
            'name.unique' => 'This category name already exists. Please choose a different name.',
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
    public function edit($id): View
    {
        $category = FaqCategory::findOrFail($id);
        return view('admin.faq.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $category = FaqCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name,' . $category->id,
        ], [
            'name.required' => 'The category name is required.',
            'name.max' => 'The category name must not exceed 255 characters.',
            'name.unique' => 'This category name already exists. Please choose a different name.',
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
    public function destroy($id): RedirectResponse
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category deleted successfully.');
    }
}
