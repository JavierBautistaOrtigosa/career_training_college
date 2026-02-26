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
            //
      }

      // Show edit form
      public function edit($id)
      {
            //
      }

      // Handle update form submission
      public function update(Request $request, $id)
      {
            //
      }

      // Delete a member
      public function destroy($id)
      {
            //
      }
}
