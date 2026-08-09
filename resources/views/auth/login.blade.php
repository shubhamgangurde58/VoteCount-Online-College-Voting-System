@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Student Login</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Roll Number</label>
                        <input type="text" name="roll_no" class="form-control" value="{{ old('roll_no') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </p>
                <p class="text-center">
                    <a href="{{ route('admin.login') }}" class="text-muted">Admin Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection