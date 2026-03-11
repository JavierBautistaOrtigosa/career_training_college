<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
      // Show login form
      public function loginForm()
      {
            return view('auth.login');
      }

      // Handle login
      public function login(Request $request)
      {
            // Validate input
            $request->validate([
                  'email' => 'required|email',
                  'password' => 'required'
            ]);

            // Find user
            $user = User::where('email', $request->email)->first();

            // Check credentials
            if (!$user || !Hash::check($request->password, $user->password)) {
                  return back()->with('error', 'Invalid email or password');
            }

            // CLASS-DEMO STYLE: set login flags
            $request->session()->put('isLoggedIn', true);
            $request->session()->put('user_id', $user->id);

            // Store the role in the session (admin/user)
            $request->session()->put('role', $user->role);

            return redirect('/members');
      }

      // Logout
      public function logout(Request $request)
      {
            $request->session()->flush();
            return redirect('/login')->with('error', 'Your session has ended. Please log in again.');
      }
}
