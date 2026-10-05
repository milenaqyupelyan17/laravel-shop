<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',

                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],

                'current_password' => 'nullable|required_with:password',

                'password' => [
                    'nullable',
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

                'current_password.required_with' =>
                'Current password is required when changing your password.',

                'password.min' =>
                'Password must contain at least 6 characters.',

                'password.confirmed' =>
                'Passwords do not match.',

                'password.regex' =>
                'Password must contain at least one uppercase and one lowercase letter.',
            ]
        );

        $nameChanged = $user->name !== $validated['name'];
        $emailChanged = $user->email !== $validated['email'];
        $passwordChanged = !empty($validated['password']);


        if (!$nameChanged && !$emailChanged && !$passwordChanged) {
            return back()
                ->with('error', 'You have not changed anything.')
                ->withInput();
        }

        if ($passwordChanged) {

            if (
                empty($validated['current_password']) ||
                !Hash::check(
                    $validated['current_password'],
                    $user->password
                )
            ) {
                return back()
                    ->withErrors([
                        'current_password' => 'Current password is incorrect.',
                    ])
                    ->withInput();
            }

            $user->password = Hash::make($validated['password']);
        }


        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();


        return back()->with(
            'success',
            'Your settings have been updated successfully!'
        );
    }
}
