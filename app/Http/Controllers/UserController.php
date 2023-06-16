<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6']
        ]);
    
        $user = User::create([
            'username' => $formFields['username'],
            'email' => $formFields['email'],
            'password' => bcrypt($formFields['password'])
        ]);
    
        auth()->login($user);
    
        return redirect('/profile')->with('success', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('email');

        return redirect('/login')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login(Request $request) {
        if ($request->session()->has('email')) {
            return redirect('/profile');
        } 
        return view('users.login');
    }

    

    public function authenticate(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($data)) {
            // Authentication successful
            $user = auth()->user();
            $request->session()->put('email', $user);
        
            return redirect('/profile');
           
        }

        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }

    public function profile() {
        return view ('users.profile');
    }
}
