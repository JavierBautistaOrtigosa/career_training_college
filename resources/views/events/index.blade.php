@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Events</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            {{-- HEADER ROW --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="mb-0 fw-semibold">Event Records</h5>

                  <div class="d-flex align-items-center">
                        <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary btn-sm me-2">
                              Card View
                        </a>

                        @if (session('role') === 'admin')
                        <a href="{{ route('events.create') }}" class="btn btn-outline-primary btn-sm">
                              Add Event
                        </a>
                        @else
                        <button class="btn btn-outline-primary btn-sm d-none">Add Event</button>
                        @endif
                  </div>
            </div>

            {{-- FILTERS + SORTING --}}
            <form method="GET" action="{{ route('events.index') }}" class="row g-3 mb-4">

                  {{-- SEARCH: Title --}}
                  <div class="col-md-3">
                        <label class="form-label fw-semibold">Search Title</label>
                        <input type="text" name="search" class="form-control"
                              placeholder="Search events..."
                              value="{{ request('search') }}">
                  </div>

                  {{-- FILTER: Category --}}
                  <div class="col-md-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category" class="form-select">
                              <option value="">All Categories</option>
                              <option value="Workshop" {{ request('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                              <option value="Seminar" {{ request('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                              <option value="Training" {{ request('category') == 'Training' ? 'selected' : '' }}>Training</option>
                        </select>
                  </div>

                  {{-- FILTER: Location --}}
                  <div class="col-md-3">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" class="form-control"
                              placeholder="Search location..."
                              value="{{ request('location') }}">
                  </div>

                  {{-- SORTING --}}
                  <div class="col-md-3">
                        <label class="form-label fw-semibold">Sort By</label>
                        <select name="sort" class="form-select">
                              <option value="">Default (Oldest First)</option>
                              <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date: Oldest → Newest</option>
                              <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date: Newest → Oldest</option>
                              <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title: A → Z</option>
                              <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title: Z → A</option>
                        </select>
                  </div>

                  {{-- BUTTONS --}}
                  <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">
                              Reset Filters
                        </a>

                        <button class="btn btn-primary btn-sm">
                              Apply Filters
                        </button>
                  </div>

            </form>


            {{-- TABLE WRAPPER --}}
            <div class="table-responsive border rounded-3 overflow-hidden">
                  <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                              <tr>
                                    <th class="fw-semibold px-3">ID</th>
                                    <th class="fw-semibold px-3">Title</th>
                                    <th class="fw-semibold px-3">Date & Time</th>
                                    <th class="fw-semibold px-3">Location</th>
                                    <th class="fw-semibold px-3">Category</th>

                                    @if (session('role') === 'admin')
                                    <th class="text-end fw-semibold px-3">Actions</th>
                                    @else
                                    <th class="px-3"></th>
                                    @endif
                              </tr>
                        </thead>

                        <tbody>
                              @foreach ($events as $event)
                              <tr>
                                    <td class="px-3">{{ $event->id }}</td>
                                    <td class="px-3">{{ $event->title }}</td>
                                    <td class="px-3">
                                          {{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}
                                    </td>
                                    <td class="px-3">{{ $event->location }}</td>
                                    <td class="px-3">{{ $event->category }}</td>

                                    @if (session('role') === 'admin')
                                    <td class="px-3 text-end">
                                          <div class="d-inline-flex gap-2">

                                                <a href="{{ route('events.edit', $event->id) }}"
                                                      class="btn btn-outline-warning btn-sm">
                                                      Edit
                                                </a>

                                                <form action="{{ route('events.destroy', $event->id) }}"
                                                      method="POST" style="display:inline;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                                            Delete
                                                      </button>
                                                </form>

                                          </div>
                                    </td>
                                    @else
                                    <td class="px-3"></td>
                                    @endif
                              </tr>
                              @endforeach
                        </tbody>

                  </table>
            </div>

            {{-- PAGINATION (MUST BE OUTSIDE TABLE-RESPONSIVE) --}}
            <div class="mt-4">
                  {{ $events->links() }}
            </div>

      </div>
</div>

@endsection