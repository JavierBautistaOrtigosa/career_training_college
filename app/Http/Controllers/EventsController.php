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

            // (Filters will be added later)
            // (Sorting will be added later)

            $events = $query->paginate(10);

            return view('events.index', compact('events'));
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
                  return redirect('/events')->with('error', 'You do not have permission to perform this action.');
            }

            return view('events.create');
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
                  return redirect('/events')->with('error', 'You do not have permission to perform this action.');
            }

            // Validate form input
            $request->validate([
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required',
                  'description' => 'nullable'
            ]);

            // Create new event
            Event::create([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category
            ]);

            // Redirect back to events list
            return redirect()->route('events.index');
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
                  return redirect('/events')->with('error', 'You do not have permission to perform this action.');
            }

            // Find the event
            $event = Event::findOrFail($id);

            // Return the edit view
            return view('events.edit', compact('event'));
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
                  return redirect('/events')->with('error', 'You do not have permission to perform this action.');
            }

            // Validate form input
            $request->validate([
                  'title' => 'required',
                  'date_time' => 'required',
                  'location' => 'required',
                  'category' => 'required',
                  'description' => 'nullable'
            ]);

            // Find the event
            $event = Event::findOrFail($id);

            // Update the event
            $event->update([
                  'title' => $request->title,
                  'date_time' => $request->date_time,
                  'location' => $request->location,
                  'description' => $request->description,
                  'category' => $request->category
            ]);

            // Redirect back to events list
            return redirect()->route('events.index');
      }


      // Delete an event
      public function destroy($id)
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Admin-only protection
            if (session('role') !== 'admin') {
                  return redirect('/events')->with('error', 'You do not have permission to perform this action.');
            }

            // Find the event
            $event = Event::findOrFail($id);

            // Delete the event
            $event->delete();

            // Redirect back to events list
            return redirect()->route('events.index');
      }


      // Cards View
      public function cards(Request $request)
      {
            $events = Event::paginate(10);
            return view('events.cards', compact('events'));
      }
}
