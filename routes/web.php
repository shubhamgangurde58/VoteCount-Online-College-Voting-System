<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;

// Default route - redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// ---------------- STUDENT AUTH ROUTES ----------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------------- STUDENT VOTING ROUTES (Protected) ----------------
Route::middleware('auth')->group(function () {
    Route::get('/ballot', [VoteController::class, 'ballot'])->name('ballot');
    Route::post('/vote', [VoteController::class, 'castVote'])->name('vote.cast');
    Route::get('/result', [VoteController::class, 'result'])->name('result');
});

// ---------------- ADMIN ROUTES ----------------
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.attempt');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/candidates', [AdminController::class, 'candidates'])->name('admin.candidates');
    Route::post('/candidates', [AdminController::class, 'storeCandidate'])->name('admin.candidates.store');
    Route::delete('/candidates/{id}', [AdminController::class, 'deleteCandidate'])->name('admin.candidates.delete');
    Route::get('/elections', [AdminController::class, 'elections'])->name('admin.elections');
    Route::post('/elections', [AdminController::class, 'storeElection'])->name('admin.elections.store');
    
});