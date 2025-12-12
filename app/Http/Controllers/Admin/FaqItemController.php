<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = FaqItem::with('category');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('faq_category_id', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        $items = $query->orderBy('faq_category_id')->orderBy('order')->paginate(15);
        $categories = FaqCategory::orderBy('order')->get();

        return view('admin.faq.items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $categories = FaqCategory::orderBy('order')->get();
        $selectedCategory = $request->get('category');
        
        return view('admin.faq.items.create', compact('categories', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|min:10',
            'order' => 'nullable|integer|min:0',
        ], [
            'faq_category_id.required' => 'Please select a category.',
            'faq_category_id.exists' => 'The selected category is invalid.',
            'question.required' => 'The question field is required.',
            'question.max' => 'The question must not exceed 255 characters.',
            'answer.required' => 'The answer field is required.',
            'answer.min' => 'The answer must be at least 10 characters.',
            'order.integer' => 'The order must be a valid number.',
            'order.min' => 'The order must be at least 0.',
        ]);

        // If no order specified, add to end of category
        if (!isset($validated['order'])) {
            $validated['order'] = FaqItem::where('faq_category_id', $validated['faq_category_id'])->max('order') + 1;
        }

        FaqItem::create($validated);

        return redirect()->route('admin.faq.items.index')
            ->with('success', 'FAQ item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $item = FaqItem::with('category')->findOrFail($id);
        $categories = FaqCategory::orderBy('order')->get();
        
        return view('admin.faq.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $item = FaqItem::findOrFail($id);
        
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|min:10',
            'order' => 'required|integer|min:0',
        ], [
            'faq_category_id.required' => 'Please select a category.',
            'faq_category_id.exists' => 'The selected category is invalid.',
            'question.required' => 'The question field is required.',
            'question.max' => 'The question must not exceed 255 characters.',
            'answer.required' => 'The answer field is required.',
            'answer.min' => 'The answer must be at least 10 characters.',
            'order.required' => 'The order field is required.',
            'order.integer' => 'The order must be a valid number.',
            'order.min' => 'The order must be at least 0.',
        ]);

        $item->update($validated);

        return redirect()->route('admin.faq.items.index')
            ->with('success', 'FAQ item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $item = FaqItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.faq.items.index')
            ->with('success', 'FAQ item deleted successfully.');
    }
}
