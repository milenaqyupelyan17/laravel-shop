<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignIn()
    {
        return view('sign_in');
    }
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
                'password.regex' => 'Password must contain at least one lowercase and one uppercase letter.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()
            ->route('dashboard')
            ->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }
        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
    public function updateSettings(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            if (
                !$request->filled('current_password') ||
                !Hash::check(
                    $request->current_password,
                    $user->password
                )
            ) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect.'
                ]);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return back()->with(
            'success',
            'Your settings have been updated successfully.'
        );
    }
}
