@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Add New Event</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Event Title</label>
                        <input
                              type="text"
                              name="title"
                              class="form-control"
                              placeholder="Enter event title"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Date & Time</label>
                        <input
                              type="datetime-local"
                              name="date_time"
                              class="form-control"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Location</label>
                        <input
                              type="text"
                              name="location"
                              class="form-control"
                              placeholder="Enter event location"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category" class="form-select" required>
                              <option value="">Select category</option>
                              <option value="Workshop">Workshop</option>
                              <option value="Seminar">Seminar</option>
                              <option value="Training">Training</option>
                              <option value="Webinar">Webinar</option>
                        </select>
                  </div>


                  <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea
                              name="description"
                              class="form-control"
                              rows="3"
                              placeholder="Enter event description"></textarea>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Event Image (optional)</label>
                        <input
                              type="file"
                              name="image"
                              class="form-control"
                              accept="image/*">
                  </div>


                  <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">
                              Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                              Save Event
                        </button>
                  </div>

            </form>

      </div>
</div>

@endsection