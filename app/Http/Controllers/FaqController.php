<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page with all categories.
     */
    public function index()
    {
        $categories = FaqCategory::withCount('faqItems')
            ->orderBy('order')
            ->get();

        return view('faq.index', compact('categories'));
    }

    /**
     * Display a specific FAQ category with its items.
     */
    public function show(FaqCategory $category)
    {
        $category->load('faqItems');
        
        return view('faq.show', compact('category'));
    }
}
