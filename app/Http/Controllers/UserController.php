<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        // Display the user registration form
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate and store the newly created user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // You can use the data to create a new User model and save it to the database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        // Log in the user (optional, you can redirect to the login page)
        auth()->attempt($request->only('email', 'password'));

        return redirect('/'); // Redirect to the homepage or another suitable page
    }

    public function showLoginForm()
    {
        // Display the login form
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate user credentials and log them in
        // This method will receive the login data from the form in the $request variable
        // You can use this data to authenticate the user
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
        // Authentication passed
        return redirect('/dashboard'); // Redirect to the dashboard or another page
        } else {
        // Authentication failed
        return back()->withErrors(['email' => 'Invalid login credentials']);
        }
    }

    public function logout()
    {
        // Log the user out
    }
}
