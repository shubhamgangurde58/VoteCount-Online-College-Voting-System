<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show admin login form
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid username or password'])->onlyInput('username');
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Admin dashboard
    public function dashboard()
    {
        $totalStudents = \App\Models\Student::count();
        $totalVoted = \App\Models\Student::where('has_voted', true)->count();
        $totalCandidates = Candidate::count();
        $totalElections = Election::count();

        return view('admin.dashboard', compact('totalStudents', 'totalVoted', 'totalCandidates', 'totalElections'));
    }

    // Show candidates list + add form
    public function candidates()
    {
        $candidates = Candidate::with('election')->get();
        $elections = Election::all();
        return view('admin.candidates', compact('candidates', 'elections'));
    }

    // Store new candidate
    public function storeCandidate(Request $request)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'name' => 'required|string|max:100',
            'department' => 'nullable|string|max:100',
            'manifesto' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('candidates', 'public');
        }

        Candidate::create([
            'election_id' => $request->election_id,
            'name' => $request->name,
            'department' => $request->department,
            'manifesto' => $request->manifesto,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.candidates')->with('success', 'Candidate added successfully!');
    }

    // Delete candidate
    public function deleteCandidate($id)
    {
        Candidate::destroy($id);
        return redirect()->route('admin.candidates')->with('success', 'Candidate deleted!');
    }

    // Show elections list + add form
    public function elections()
    {
        $elections = Election::all();
        return view('admin.elections', compact('elections'));
    }

    // Store new election
    public function storeElection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:upcoming,active,closed',
        ]);

        Election::create($request->only('title', 'start_date', 'end_date', 'status'));

        return redirect()->route('admin.elections')->with('success', 'Election created successfully!');
    }
}