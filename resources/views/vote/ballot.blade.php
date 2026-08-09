@extends('layouts.app')

@section('title', 'Cast Your Vote')

@section('content')

@if(!$election)
    <div class="alert alert-warning text-center mt-4">
        No active election right now. Please check back later.
    </div>
@else
    <h3 class="mb-4 text-center">{{ $election->title }}</h3>
    <p class="text-center text-muted mb-4">Select a candidate and cast your vote</p>

    <form action="{{ route('vote.cast') }}" method="POST" id="voteForm">
        @csrf
        <input type="hidden" name="election_id" value="{{ $election->id }}">
        <input type="hidden" name="candidate_id" id="selectedCandidate">

        <div class="row g-4">
            @forelse($candidates as $candidate)
                <div class="col-md-4">
                    <div class="card candidate-card h-100 shadow-sm" style="cursor:pointer;" onclick="selectCandidate({{ $candidate->id }}, this)">
                        <figure class="text-center pt-3 mb-0">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}" class="rounded-circle" width="100" height="100" style="object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-secondary mx-auto d-flex align-items-center justify-content-center text-white" style="width:100px;height:100px;">
                                    {{ substr($candidate->name, 0, 1) }}
                                </div>
                            @endif
                        </figure>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">{{ $candidate->name }}</h5>
                            <p class="text-muted small">{{ $candidate->department }}</p>
                            <p class="card-text small">{{ Str::limit($candidate->manifesto, 80) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No candidates added yet for this election.</p>
            @endforelse
        </div>

        @if($candidates->count() > 0)
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg" id="submitVoteBtn" disabled>
                    Cast Vote
                </button>
            </div>
        @endif
    </form>
@endif

<script>
function selectCandidate(id, el) {
    document.getElementById('selectedCandidate').value = id;
    document.querySelectorAll('.candidate-card').forEach(c => c.classList.remove('border-primary', 'border-3'));
    el.classList.add('border-primary', 'border-3');
    document.getElementById('submitVoteBtn').disabled = false;
}

document.getElementById('voteForm')?.addEventListener('submit', function(e) {
    if (!confirm('Are you sure you want to cast your vote? This action cannot be undone.')) {
        e.preventDefault();
    }
});
</script>
@endsection