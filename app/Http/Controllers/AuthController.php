<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
      // Show login form (GET /login)
      public function loginForm()
      {
            return view('auth.login');
      }

      // Handle login submission (POST /login)
      public function login(Request $request)
      {
            // Validate input fields
            $request->validate([
                  'email' => 'required|email',
                  'password' => 'required'
            ]);

            // Attempt to find user by email
            $user = User::where('email', $request->email)->first();

            // Verify user exists AND password matches hashed password
            if (!$user || !Hash::check($request->password, $user->password)) {
                  return back()->with('error', 'Invalid email or password');
            }

            // CLASS-DEMO STYLE: store login session flags
            $request->session()->put('isLoggedIn', true);
            $request->session()->put('user_id', $user->id);

            // Store user role in session (admin/user)
            $request->session()->put('role', $user->role);

            // Redirect to members index after successful login
            return redirect('/members');
      }

      // Logout user and clear session
      public function logout(Request $request)
      {
            // Remove all session data
            $request->session()->flush();

            // Redirect back to login page with message
            return redirect('/login')->with('error', 'Your session has ended. Please log in again.');
      }
}
