@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<h3 class="mb-4">📊 Admin Dashboard</h3>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body text-center">
                <h6>Total Students</h6>
                <h2>{{ $totalStudents }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success shadow">
            <div class="card-body text-center">
                <h6>Votes Cast</h6>
                <h2>{{ $totalVoted }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body text-center">
                <h6>Total Candidates</h6>
                <h2>{{ $totalCandidates }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info shadow">
            <div class="card-body text-center">
                <h6>Total Elections</h6>
                <h2>{{ $totalElections }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="mt-5 d-flex gap-3">
    <a href="{{ route('admin.elections') }}" class="btn btn-outline-primary">Manage Elections</a>
    <a href="{{ route('admin.candidates') }}" class="btn btn-outline-success">Manage Candidates</a>
    <a href="{{ route('result') }}" class="btn btn-outline-dark">View Results</a>
</div>

@endsection