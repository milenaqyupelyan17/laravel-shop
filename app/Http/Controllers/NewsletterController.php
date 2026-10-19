<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        if (Newsletter::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered.',
            ], 409);
        }

        Newsletter::create([
            'email' => $email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your email has been successfully registered!',
        ]);
    }
}
