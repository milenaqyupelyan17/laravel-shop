<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        $nameChanged = $request->name !== $user->name;
        $emailChanged = $request->email !== $user->email;
        $passwordFieldsFilled =
            $request->filled('current_password') ||
            $request->filled('password') ||
            $request->filled('password_confirmation');

        if (!$nameChanged && !$emailChanged && !$passwordFieldsFilled) {
            return back()->withErrors([
                'settings' => 'Please change at least one field.'
            ]);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        if ($nameChanged) {
            $user->name = $request->name;
        }
        if ($emailChanged) {
            $user->email = $request->email;
        }
        if ($passwordFieldsFilled) {
            if (!$request->filled('current_password')) {
                return back()->withErrors([
                    'current_password' =>
                    'Please enter your current password.'
                ]);
            }
            if (!$request->filled('password')) {
                return back()->withErrors([
                    'password' =>
                    'Please enter a new password.'
                ]);
            }
            if (!$request->filled('password_confirmation')) {
                return back()->withErrors([
                    'password_confirmation' =>
                    'Please confirm your new password.'
                ]);
            }
            if (!Hash::check(
                $request->current_password,
                $user->password
            )) {
                return back()->withErrors([
                    'current_password' =>
                    'Current password is incorrect.'
                ]);
            }
            if ($request->password !== $request->password_confirmation) {
                return back()->withErrors([
                    'password_confirmation' =>
                    'Passwords do not match.'
                ]);
            }
            if (strlen($request->password) < 6) {
                return back()->withErrors([
                    'password' =>
                    'Password must be at least 6 characters.'
                ]);
            }
            $user->password = Hash::make(
                $request->password
            );
        }
        $user->save();
        if ($passwordFieldsFilled) {
            return back()->with(
                'success',
                'Password changed successfully!'
            );
        }
        return back()->with(
            'success',
            'Account information updated successfully!'
        );
    }
}
