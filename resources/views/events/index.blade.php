@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <h2 class="mb-4">Events List</h2>

      <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Add New Event</a>

      <table class="table table-bordered">
            <thead>
                  <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>Actions</th>
                  </tr>
            </thead>

            <tbody>
                  @foreach ($events as $event)
                  <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date_time }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->category }}</td>

                        <td>
                              <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>

                              <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        </td>
                  </tr>
                  @endforeach
            </tbody>
      </table>

</div>
@endsection