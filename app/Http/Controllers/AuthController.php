<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'roll_no' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'roll_no' => $request->roll_no,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('ballot');
        }

        return back()->withErrors(['roll_no' => 'Invalid roll number or password'])->onlyInput('roll_no');
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'roll_no' => 'required|unique:students,roll_no',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
            'department' => 'nullable|string|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'roll_no' => $request->roll_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}