@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <h2 class="mb-4">Edit Event</h2>

      <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                  <label class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Date & Time</label>
                  <input type="datetime-local" name="date_time" class="form-control"
                        value="{{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Location</label>
                  <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Category</label>
                  <input type="text" name="category" class="form-control" value="{{ $event->category }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control">{{ $event->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
      </form>

</div>
@endsection