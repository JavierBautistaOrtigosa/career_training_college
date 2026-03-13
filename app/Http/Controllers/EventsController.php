<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
      // List all events
      public function index(Request $request)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            $query = Event::query();

            // SEARCH: Title
            if ($request->filled('search')) {
                  $query->where('title', 'like', '%' . $request->search . '%');
            }

            // FILTER: Category
            if ($request->filled('category')) {
                  $query->where('category', $request->category);
            }

            // FILTER: Location
            if ($request->filled('location')) {
                  $query->where('location', 'like', '%' . $request->location . '%');
            }

            // SORTING
            if ($request->filled('sort')) {
                  switch ($request->sort) {
                        case 'date_asc':
                              $query->orderBy('date_time', 'asc');
                              break;

                        case 'date_desc':
                              $query->orderBy('date_time', 'desc');
                              break;

                        case 'title_asc':
                              $query->orderBy('title', 'asc');
                              break;

                        case 'title_desc':
                              $query->orderBy('title', 'desc');
                              break;
                  }
            } else {
                  // Default sorting
                  $query->orderBy('date_time', 'asc');
            }

            // PAGINATION (preserve filters)
            $events = $query->paginate(10)->appends($request->query());

            // FIX: categories for filter UI
            $categories = Event::select('category')->distinct()->pluck('category');
            return view('events.index', compact('events', 'categories'));
      }


      // Show create form
      public function create()
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection (fixed)
            if (session('role') !== 'admin') {
                  abort(403);
            }

            return view('events.create');
      }


      // Handle create form submission
      public function store(Request $request)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection (fixed)
            if (session('role') !== 'admin') {
                  abort(403);
            }

            $request->validate([
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required',
                  'description' => 'nullable'
            ]);

            Event::create([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category
            ]);

            return redirect()->route('events.index');
      }


      // Show edit form
      public function edit($id)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection (fixed)
            if (session('role') !== 'admin') {
                  abort(403);
            }

            $event = Event::findOrFail($id);

            return view('events.edit', compact('event'));
      }


      // Handle update form submission
      public function update(Request $request, $id)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection (fixed)
            if (session('role') !== 'admin') {
                  abort(403);
            }

            $request->validate([
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required',
                  'description' => 'nullable'
            ]);

            $event = Event::findOrFail($id);

            $event->update([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category
            ]);

            return redirect()->route('events.index');
      }


      // Delete an event
      public function destroy($id)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection (fixed)
            if (session('role') !== 'admin') {
                  abort(403);
            }

            $event = Event::findOrFail($id);

            $event->delete();

            return redirect()->route('events.index');
      }


      // Cards View
      public function cards(Request $request)
      {
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            $query = Event::query();

            // SEARCH: Title
            if ($request->filled('search')) {
                  $query->where('title', 'like', '%' . $request->search . '%');
            }

            // FILTER: Category
            if ($request->filled('category')) {
                  $query->where('category', $request->category);
            }

            // FILTER: Location
            if ($request->filled('location')) {
                  $query->where('location', 'like', '%' . $request->location . '%');
            }

            // SORTING
            if ($request->filled('sort')) {
                  switch ($request->sort) {
                        case 'date_asc':
                              $query->orderBy('date_time', 'asc');
                              break;

                        case 'date_desc':
                              $query->orderBy('date_time', 'desc');
                              break;

                        case 'title_asc':
                              $query->orderBy('title', 'asc');
                              break;

                        case 'title_desc':
                              $query->orderBy('title', 'desc');
                              break;
                  }
            } else {
                  $query->orderBy('date_time', 'asc');
            }

            $events = $query->paginate(10)->appends($request->query());

            // FIX: categories for filter UI (if cards view uses them)
            $categories = Event::select('category')->distinct()->pluck('category');
            return view('events.cards', compact('events', 'categories'));
      }
}
