@extends('layouts.app')

@section('title', 'Manage Candidates')

@section('content')

<h3 class="mb-4">👤 Manage Candidates</h3>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow p-3">
            <h5 class="mb-3">Add New Candidate</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Election</label>
                    <select name="election_id" class="form-select" required>
                        <option value="">-- Select Election --</option>
                        @foreach($elections as $election)
                            <option value="{{ $election->id }}">{{ $election->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Candidate Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Manifesto</label>
                    <textarea name="manifesto" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success w-100">Add Candidate</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <h5 class="mb-3">All Candidates</h5>
        <div class="row g-3">
            @forelse($candidates as $candidate)
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center gap-3">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}" class="rounded-circle" width="60" height="60" style="object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width:60px;height:60px;">
                                    {{ substr($candidate->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $candidate->name }}</h6>
                                <small class="text-muted">{{ $candidate->election->title ?? 'N/A' }}</small><br>
                                <small class="text-primary">{{ $candidate->votes_count }} votes</small>
                            </div>
                            <form action="{{ route('admin.candidates.delete', $candidate->id) }}" method="POST" onsubmit="return confirm('Delete this candidate?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No candidates added yet.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Back to Dashboard</a>
</div>

@endsection