<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',

                'email' => 'required|email|unique:users,email',

                'password' => [
                    'required',
                    'min:6',
                    'confirmed',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                ],
            ],
            [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must contain at least 6 characters.',
                'password.confirmed' => 'Passwords do not match.',
                'password.regex' => 'Password must contain at least one uppercase and one lowercase letter.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Account created successfully!');
    }
}
