<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MembersController;


// Login page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// Login form submission
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Home page (protected manually)
Route::get('/home', function () {
      return view('home');
});

// Members CRUD

Route::get('/members', [MembersController::class, 'index'])->name('members.index');
Route::get('/members/create', [MembersController::class, 'create'])->name('members.create');
Route::post('/members', [MembersController::class, 'store'])->name('members.store');
Route::get('/members/{id}/edit', [MembersController::class, 'edit'])->name('members.edit');
Route::put('/members/{id}', [MembersController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MembersController::class, 'destroy'])->name('members.destroy');
