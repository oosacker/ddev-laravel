<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'body' => 'required|string',
        ]);

        Mail::to('admin@example.com')->send(
            new ContactFormSubmission(
                $validated['name'],
                $validated['email'],
                $validated['body']
            )
        );

        return back()->with('success', 'Thanks for your message!');
    }
}
