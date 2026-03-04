<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MembersController;

// Redirect root URL to the login page
Route::get('/', function () {
      return redirect()->route('login');
});

Route::get('/', function () {
      return redirect()->route('login');
});

// Login page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// Login form submission
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// About
Route::get('/about', function () {
      return view('about');
})->name('about');



/*
|--------------------------------------------------------------------------
| Members CRUD Routes
|--------------------------------------------------------------------------
| These routes are NOT protected by middleware because we are following
| the class-demo style manual authentication.
|
| Each MembersController method will manually check:
| 
|     if (!session('isLoggedIn')) {
|         return redirect('/login');
|     }
|
| This keeps the logic simple and matches the teacher's expectations.
*/


// Members CRUD
Route::get('/members', [MembersController::class, 'index'])->name('members.index');
Route::get('/members/create', [MembersController::class, 'create'])->name('members.create');
Route::post('/members', [MembersController::class, 'store'])->name('members.store');
Route::get('/members/{id}/edit', [MembersController::class, 'edit'])->name('members.edit');
Route::put('/members/{id}', [MembersController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MembersController::class, 'destroy'])->name('members.destroy');


/*
|--------------------------------------------------------------------------
| Events CRUD Routes
|--------------------------------------------------------------------------
| These routes follow the same class-demo style manual authentication
| used in the MembersController.
|
| Each EventsController method will manually check:
|
|     if (!session('isLoggedIn')) {
|         return redirect('/login');
|     }
|
| This keeps the logic simple and consistent with the rest of the project.
*/


// Events CRUD
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
Route::post('/events', [EventsController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventsController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventsController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventsController::class, 'destroy'])->name('events.destroy');
