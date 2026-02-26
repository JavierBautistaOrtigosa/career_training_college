<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
      // List all members
      public function index()
      {
            // Get all members from the database
            $members = Member::all();

            // Return the view with the data 
            return view('members.index', ['members' => $members]);
      }

      // Show create form
      public function create()
      {
            // Manual login protection (class-demo style) 
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }
            return view('members.create');
      }

      // Handle create form submission
      public function store(Request $request)
      {
            // Manual login protection 

            if (!session('isLoggedIn')) {
                  return redirect('/login');
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
            // Manual login protection 

            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Find the member 

            $member = Member::findOrFail($id);

            // Return the edit view 

            return view('members.edit', compact('member'));
      }

      // Handle update form submission
      public function update(Request $request, $id)
      {
            // Manual login protection

            if (!session('isLoggedIn')) {
                  return redirect('/login');
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
            //
      }
}
