<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Handle a contact form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        // Hidden honeypot field: bots that fill it in are silently accepted and dropped.
        if ($request->filled('website')) {
            return redirect()
                ->to(route('home').'#contact')
                ->with('status', 'Thanks! Your message has been sent.');
        }

        ContactMessage::create($validated);

        // Optional email notification — enable once MAIL_* credentials are configured.
        // Mail::to(config('mail.from.address'))->send(new ContactMessageMail($validated));

        return redirect()
            ->to(route('home').'#contact')
            ->with('status', "Thanks, {$validated['name']}! Your message has been sent — I'll get back to you soon.");
    }
}
