<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (Newsletter::where('email', $request->email)->exists()) {
            return back()
                ->withInput()
                ->with('newsletter_error', 'This email is already registered.');
        }

        Newsletter::create([
            'email' => $request->email,
        ]);

        return back()->with(
            'newsletter_success',
            'Your email has been successfully registered!'
        );
    }
}
