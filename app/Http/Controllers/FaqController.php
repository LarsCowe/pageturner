<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page with all categories and items.
     */
    public function index()
    {
        $categories = FaqCategory::with('faqItems')
            ->orderBy('order')
            ->get();

        return view('faq.index', compact('categories'));
    }
}
