<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
      // Display events list with filters, sorting, and pagination
      public function index(Request $request)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Base query
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

            // SORTING LOGIC
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
                  // Default sort: oldest first
                  $query->orderBy('date_time', 'asc');
            }

            // PAGINATION (preserve filters)
            $events = $query->paginate(10)->appends($request->query());

            // Distinct categories for filter dropdown
            $categories = Event::select('category')->distinct()->pluck('category');

            return view('events.index', compact('events', 'categories'));
      }


      // Show create event form
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

            return view('events.create');
      }


      // Handle create event submission
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
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required|in:Workshop,Seminar,Training,Webinar',
                  'description' => 'nullable',
                  'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // IMAGE UPLOAD (optional)
            $path = null;
            if ($request->hasFile('image')) {
                  $path = $request->file('image')->store('event_images', 'public');
            }

            // Create event record
            Event::create([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category,
                  'image_path' => $path
            ]);

            return redirect()->route('events.index')
                  ->with('success', 'Event created successfully!');
      }


      // Show edit event form
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

            // Fetch event or fail
            $event = Event::findOrFail($id);

            return view('events.edit', compact('event'));
      }


      // Handle update event submission
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
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required|in:Workshop,Seminar,Training,Webinar',
                  'description' => 'nullable',
                  'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Fetch event
            $event = Event::findOrFail($id);

            // IMAGE RE-UPLOAD LOGIC
            if ($request->hasFile('image')) {

                  // Delete old image if exists
                  if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
                        Storage::disk('public')->delete($event->image_path);
                  }

                  // Store new image
                  $newPath = $request->file('image')->store('event_images', 'public');

                  // Update model field
                  $event->image_path = $newPath;
            }

            // Update event fields
            $event->update([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category,
                  'image_path' => $event->image_path
            ]);

            return redirect()->route('events.index')
                  ->with('success', 'Event updated successfully!');
      }


      // Delete an event
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

            // Fetch event
            $event = Event::findOrFail($id);

            // Delete event record
            $event->delete();

            return redirect()->route('events.index');
      }


      // Card view version of events list
      public function cards(Request $request)
      {
            // Require login
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Base query
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

            // SORTING LOGIC
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
                  // Default sort
                  $query->orderBy('date_time', 'asc');
            }

            // Paginate results
            $events = $query->paginate(10)->appends($request->query());

            // Distinct categories for filter dropdown
            $categories = Event::select('category')->distinct()->pluck('category');

            return view('events.cards', compact('events', 'categories'));
      }
}
