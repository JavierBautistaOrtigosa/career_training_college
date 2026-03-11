<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
      // List all members
      public function index()
      {

            // Manual login protection 

            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            $members = Member::all();
            return view('members.index', ['members' => $members]);
      }

      // Show create form
      public function create()
      {
            // Manual login protection (class-demo style) 
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/members')->with('error', 'You do not have permission to perform this action.');
            }

            return view('members.create');
      }


      // Handle create form submission
      public function store(Request $request)
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/members')->with('error', 'You do not have permission to perform this action.');
            }

            // Validate form input
            $request->validate([
                  'first_name' => 'required',
                  'last_name' => 'required',
                  'age' => 'required|integer',
                  'email' => 'required|email',
                  'phone' => 'required',
                  'address' => 'required'
            ]);

            // Create new member
            Member::create([
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'age' => $request->age,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'address' => $request->address
            ]);

            // Redirect back to members list
            return redirect()->route('members.index');
      }


      // Show edit form
      public function edit($id)
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/members')->with('error', 'You do not have permission to perform this action.');
            }

            // Find the member
            $member = Member::findOrFail($id);

            // Return the edit view
            return view('members.edit', compact('member'));
      }

      // Handle update form submission
      public function update(Request $request, $id)
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/members')->with('error', 'You do not have permission to perform this action.');
            }

            // Validate form input
            $request->validate([
                  'first_name' => 'required',
                  'last_name' => 'required',
                  'age' => 'required|integer',
                  'email' => 'required|email',
                  'phone' => 'required',
                  'address' => 'required'
            ]);

            // Find the member
            $member = Member::findOrFail($id);

            // Update the member
            $member->update([
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'age' => $request->age,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'address' => $request->address
            ]);

            // Redirect back to members list
            return redirect()->route('members.index');
      }

      // Delete a member
      public function destroy($id)
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/members')->with('error', 'You do not have permission to perform this action.');
            }

            // Find the member
            $member = Member::findOrFail($id);

            // Delete the member
            $member->delete();

            // Redirect back to members list
            return redirect()->route('members.index');
      }


      //  Cards View
      public function cards()
      {
            $members = Member::all();
            return view('members.cards', compact('members'));
      }
}
