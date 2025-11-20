<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function create(): View
    {
        return view('contact.create');
    }

    /**
     * Store the contact form submission.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        // For now, just validate and redirect back with success message
        // Email functionality will be added in next step
        
        return redirect()->route('contact.create')
            ->with('success', 'Bedankt voor uw bericht! We nemen zo spoedig mogelijk contact met u op.');
    }
}
