<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
      // Display members list with filters, sorting, and pagination
      public function index(Request $request)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Base query
            $query = Member::query();

            // SEARCH: First or last name
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

            // SORTING LOGIC
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
                  // Default sorting: ID ascending
                  $query->orderBy('id', 'asc');
            }

            // PAGINATION (preserve filters)
            $members = $query->paginate(10)->appends($request->query());

            return view('members.index', compact('members'));
      }



      // Show create member form
      public function create()
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only access
            if (session('role') !== 'admin') {
                  abort(403);
            }

            return view('members.create');
      }


      // Handle create member submission
      public function store(Request $request)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only access
            if (session('role') !== 'admin') {
                  abort(403);
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

            // Create new member record
            Member::create([
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'age' => $request->age,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'address' => $request->address,
                  'professional_summary' => $request->professional_summary
            ]);

            return redirect()->route('members.index')->with('success', 'Member added successfully.');
      }


      // Show edit member form
      public function edit($id)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only access
            if (session('role') !== 'admin') {
                  abort(403);
            }

            // Fetch member or fail
            $member = Member::findOrFail($id);

            return view('members.edit', compact('member'));
      }


      // Handle update member submission
      public function update(Request $request, $id)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only access
            if (session('role') !== 'admin') {
                  abort(403);
            }

            // Validate input
            $request->validate([
                  'first_name' => 'required',
                  'last_name' => 'required',
                  'age' => 'required|integer|min:1|max:120',
                  'email' => 'required|email',
                  'phone' => 'required|regex:/^[0-9]{8,15}$/',
                  'address' => 'required',
                  'professional_summary' => 'nullable'
            ]);

            // Fetch member
            $member = Member::findOrFail($id);

            // Update record
            $member->update([
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'age' => $request->age,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'address' => $request->address,
                  'professional_summary' => $request->professional_summary
            ]);

            return redirect()->route('members.index')->with('success', 'Member updated successfully.');
      }


      // Delete a member
      public function destroy($id)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only access
            if (session('role') !== 'admin') {
                  abort(403);
            }

            // Fetch member
            $member = Member::findOrFail($id);

            // Delete record
            $member->delete();

            return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
      }


      // Card view version of members list
      public function cards(Request $request)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Base query
            $query = Member::query();

            // SEARCH: First or last name
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

            // SORTING LOGIC
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

            // Paginate results
            $members = $query->paginate(10)->appends($request->query());

            return view('members.cards', compact('members'));
      }
}
