@extends('layouts.app')

@section('title', 'Manage Elections')

@section('content')

<h3 class="mb-4">🗳 Manage Elections</h3>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow p-3">
            <h5 class="mb-3">Create New Election</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.elections.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Election Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="datetime-local" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="datetime-local" name="end_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="upcoming">Upcoming</option>
                        <option value="active">Active</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Create Election</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <h5 class="mb-3">All Elections</h5>
        <div class="table-responsive">
            <table class="table table-bordered bg-white shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($elections as $election)
                        <tr>
                            <td>{{ $election->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($election->start_date)->format('d M Y, h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($election->end_date)->format('d M Y, h:i A') }}</td>
                            <td>
                                <span class="badge bg-{{ $election->status == 'active' ? 'success' : ($election->status == 'closed' ? 'secondary' : 'warning') }}">
                                    {{ ucfirst($election->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No elections created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Back to Dashboard</a>
</div>

@endsection