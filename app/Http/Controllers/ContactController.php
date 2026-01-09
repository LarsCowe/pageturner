<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
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
        // Get all admin email addresses
        $adminEmails = User::where('is_admin', true)->pluck('email');

        // Queue email to all admins (ContactMail implements ShouldQueue)
        if ($adminEmails->isNotEmpty()) {
            Mail::to($adminEmails->toArray())->send(
                new ContactMail(
                    contactName: $request->name,
                    contactEmail: $request->email,
                    contactSubject: $request->subject,
                    contactMessage: $request->message
                )
            );
        }

        return redirect()->route('contact.create')
            ->with('success', 'Thank you for your message! We will get back to you as soon as possible.');
    }
}
