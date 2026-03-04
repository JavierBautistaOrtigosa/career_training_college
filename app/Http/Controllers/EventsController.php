<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
      // List all events
      public function index()
      {
            // Manual login protection 

            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Get all events from the database

            $events = Event::all();
            return view('events.index', ['events' => $events]);
      }

      // Show create form
      public function create()
      {
            // Manual login protection (class-demo style)
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            return view('events.create');
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
            // Manual login protection
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Find the event
            $event = Event::findOrFail($id);

            // Return the edit view
            return view('events.edit', compact('event'));
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
            // Manual login protection
            if (!session('isLoggedIn')) {
                  return redirect('/login');
            }

            // Find the event
            $event = Event::findOrFail($id);

            // Delete the event
            $event->delete();

            // Redirect back to events list
            return redirect()->route('events.index');
      }

      // Cards View
      public function cards()
      {
            $events = Event::all();
            return view('events.cards', compact('events'));
      }
}
