<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("login");
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_username.required' => 'Oops! Username is required. Please enter a valid email address.',
                'text_username.email' => 'Oops, the username must be a valid email. Try again!',
                'text_password.required' => 'Oops! Password is required.',
                'text_password.min' => '"Oops! Password can have a minimum of :min characters',
                'text_password.max' => '"Oops! Password can have a maximum of :max  characters',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo "OK!";
    }

    public function logout()
    {
        echo "logout";
    }
}
