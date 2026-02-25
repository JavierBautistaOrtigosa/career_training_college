<?php

use Illuminate\Support\Facades\Route;

// Default:

Route::get('/', function () {
      return view('welcome');
});

// New:

use App\Http\Controllers\AuthController;

// Login page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// Login form submission
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Home page (protected manually)
Route::get('/home', function () {
      return view('home'); // we will create this later
});
