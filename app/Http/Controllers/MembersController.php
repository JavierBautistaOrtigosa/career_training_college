<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
      // List all members
      public function index(Request $request)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            $query = Member::query();

            // SEARCH: Name (first or last)
            if ($request->filled('search')) {
                  $search = $request->search;

                  $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', "%$search%")
                              ->orWhere('last_name', 'like', "%$search%");
                  });
            }

            // SEARCH: Email
            if ($request->filled('email')) {
                  $query->where('email', 'like', '%' . $request->email . '%');
            }

            // SORTING
            if ($request->filled('sort')) {
                  switch ($request->sort) {
                        case 'name_asc':
                              $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
                              break;

                        case 'name_desc':
                              $query->orderBy('first_name', 'desc')->orderBy('last_name', 'desc');
                              break;

                        case 'id_asc':
                              $query->orderBy('id', 'asc');
                              break;

                        case 'id_desc':
                              $query->orderBy('id', 'desc');
                              break;
                  }
            } else {
                  // Default sorting
                  $query->orderBy('id', 'asc');
            }

            // PAGINATION (preserve filters)
            $members = $query->paginate(10)->appends($request->query());

            return view('members.index', compact('members'));
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
                  'age' => 'required|integer|min:1|max:120',
                  'email' => 'required|email',
                  'phone' => 'required|regex:/^[0-9]{8,15}$/',
                  'address' => 'required',
                  'professional_summary' => 'nullable'

            ]);

            // Create new member
            Member::create([
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'age' => $request->age,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'address' => $request->address,
                  'professional_summary' => $request->professional_summary

            ]);

            // Redirect back to members list
            return redirect()->route('members.index')->with('success', 'Member added successfully.');
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
                  'age' => 'required|integer|min:1|max:120',
                  'email' => 'required|email',
                  'phone' => 'required|regex:/^[0-9]{8,15}$/',
                  'address' => 'required',
                  'professional_summary' => 'nullable'

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
                  'address' => $request->address,
                  'professional_summary' => $request->professional_summary

            ]);

            // Redirect back to members list
            return redirect()->route('members.index')->with('success', 'Member updated successfully.');
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
            return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
      }


      //  Cards View
      public function cards(Request $request)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            $query = Member::query();

            // SEARCH: Name
            if ($request->filled('search')) {
                  $search = $request->search;

                  $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', "%$search%")
                              ->orWhere('last_name', 'like', "%$search%");
                  });
            }

            // SEARCH: Email
            if ($request->filled('email')) {
                  $query->where('email', 'like', '%' . $request->email . '%');
            }

            // SORTING
            if ($request->filled('sort')) {
                  switch ($request->sort) {
                        case 'name_asc':
                              $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
                              break;

                        case 'name_desc':
                              $query->orderBy('first_name', 'desc')->orderBy('last_name', 'desc');
                              break;

                        case 'id_asc':
                              $query->orderBy('id', 'asc');
                              break;

                        case 'id_desc':
                              $query->orderBy('id', 'desc');
                              break;
                  }
            } else {
                  $query->orderBy('id', 'asc');
            }

            // PAGINATION (preserve filters)
            $members = $query->paginate(10)->appends($request->query());

            return view('members.cards', compact('members'));
      }
}
