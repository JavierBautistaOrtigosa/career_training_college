@extends('layouts.app')

@section('content')

<div class="container mt-4">

      {{-- PAGE HEADER --}}
      <h1 class="page-header fw-bold heading-tight">Edit Event</h1>

      {{-- MAIN CARD WRAPPER --}}
      <div class="card-premium card-hover rounded-3 mb-4">
            <div class="card-body p-4">

                  {{-- EDIT EVENT FORM --}}
                  <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- EVENT TITLE --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Event Title</label>
                              <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    value="{{ $event->title }}"
                                    required>
                        </div>

                        {{-- DATE & TIME --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Date & Time</label>
                              <input
                                    type="datetime-local"
                                    name="date_time"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i') }}"
                                    required>
                        </div>

                        {{-- LOCATION --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Location</label>
                              <input
                                    type="text"
                                    name="location"
                                    class="form-control"
                                    value="{{ $event->location }}"
                                    required>
                        </div>

                        {{-- CATEGORY DROPDOWN --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Category</label>
                              <select name="category" class="form-select" required>
                                    <option value="">Select category</option>
                                    <option value="Workshop" {{ $event->category == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                    <option value="Seminar" {{ $event->category == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                    <option value="Training" {{ $event->category == 'Training' ? 'selected' : '' }}>Training</option>
                                    <option value="Webinar" {{ $event->category == 'Webinar' ? 'selected' : '' }}>Webinar</option>
                              </select>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Description</label>
                              <textarea
                                    name="description"
                                    class="form-control"
                                    rows="3">{{ $event->description }}</textarea>
                        </div>

                        {{-- IMAGE PREVIEW (CURRENT IMAGE) --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Current Image</label>

                              @if ($event->image_path)
                              <div class="mb-2">
                                    <img src="{{ asset('storage/' . $event->image_path) }}"
                                          alt="Event Image"
                                          class="img-fluid rounded"
                                          style="max-height: 180px; object-fit: cover;">
                              </div>
                              @else
                              <p class="text-muted">No image uploaded.</p>
                              @endif
                        </div>

                        {{-- IMAGE RE-UPLOAD --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Upload New Image (optional)</label>
                              <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="action-buttons justify-content-end gap-2 mt-4">
                              <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                              </a>
                              <button type="submit" class="btn btn-green">
                                    Update Event
                              </button>
                        </div>

                  </form>

            </div>
      </div>

</div>

@endsection