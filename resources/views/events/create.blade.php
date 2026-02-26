@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <h2 class="mb-4">Create Event</h2>

      <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                  <label class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Date & Time</label>
                  <input type="datetime-local" name="date_time" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Location</label>
                  <input type="text" name="location" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Category</label>
                  <input type="text" name="category" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create Event</button>
      </form>

</div>
@endsection