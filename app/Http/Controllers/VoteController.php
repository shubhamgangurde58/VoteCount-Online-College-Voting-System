<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    // Show ballot page with candidates
    public function ballot()
    {
        $student = Auth::user();

        // If already voted, redirect to result
        if ($student->has_voted) {
            return redirect()->route('result')->with('info', 'You have already voted.');
        }

        $election = Election::where('status', 'active')->latest()->first();

        if (!$election) {
            return view('vote.ballot', ['election' => null, 'candidates' => []]);
        }

        $candidates = Candidate::where('election_id', $election->id)->get();

        return view('vote.ballot', compact('election', 'candidates'));
    }

    // Handle vote casting
    public function castVote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'election_id' => 'required|exists:elections,id',
        ]);

        $student = Auth::user();

        // Prevent double voting
        if ($student->has_voted) {
            return redirect()->route('result')->with('error', 'You have already voted.');
        }

        // Create vote record
        Vote::create([
            'student_id' => $student->id,
            'candidate_id' => $request->candidate_id,
            'election_id' => $request->election_id,
            'voted_at' => now(),
        ]);

        // Increment candidate vote count
        Candidate::where('id', $request->candidate_id)->increment('votes_count');

        // Mark student as voted
        $student->has_voted = true;
        $student->save();

        return redirect()->route('result')->with('success', 'Your vote has been cast successfully!');
    }

    // Show result page
    public function result()
    {
        $election = Election::latest()->first();

        if (!$election) {
            return view('vote.result', ['candidates' => []]);
        }

        $candidates = Candidate::where('election_id', $election->id)
            ->orderByDesc('votes_count')
            ->get();

        return view('vote.result', compact('candidates', 'election'));
    }
}