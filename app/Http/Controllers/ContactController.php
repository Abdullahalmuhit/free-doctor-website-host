<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $chambers = \App\Models\Chamber::active()->get();

        return view('frontend.contact', compact('chambers'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Send email or save to database
        // Mail::to('admin@example.com')->send(new ContactMessage($validated));

        return back()->with('success', 'Message sent successfully!');
    }
}
