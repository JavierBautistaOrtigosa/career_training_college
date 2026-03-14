@extends('layouts.app')

@section('content')
<div class="container mt-4">

      {{-- PAGE HEADER --}}
      <h1 class="page-header fw-bold heading-tight">Events</h1>

      <div class="card-premium card-hover rounded-3">
            <div class="card-body p-4 p-tight">

                  {{-- HEADER --}}
                  <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold heading-tight mb-0">Events</h2>

                        <div class="action-buttons">
                              <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary">
                                    Card View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('events.create') }}" class="btn btn-green">
                                    + Add New Event
                              </a>
                              @endif
                        </div>
                  </div>

                  {{-- FILTERS --}}
                  <form method="GET" action="{{ route('events.index') }}" class="row g-3 mb-4">

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Search Title</label>
                              <input type="text" name="search" class="form-control"
                                    placeholder="Search event title..."
                                    value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Category</label>
                              <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category }}"
                                          {{ request('category') == $category ? 'selected' : '' }}>
                                          {{ $category }}
                                    </option>
                                    @endforeach
                              </select>
                        </div>

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Location</label>
                              <input type="text" name="location" class="form-control"
                                    placeholder="Search location..."
                                    value="{{ request('location') }}">
                        </div>

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Sort By</label>
                              <select name="sort" class="form-select">
                                    <option value="">Default (Oldest First)</option>
                                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Newest First</option>
                                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Oldest First</option>
                                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A–Z</option>
                                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z–A</option>
                              </select>
                        </div>

                        <div class="col-12 d-flex justify-content-end action-buttons">
                              <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                              <button class="btn btn-primary btn-sm">Apply</button>
                        </div>

                  </form>

                  {{-- TABLE --}}
                  <div class="table-responsive">
                        <table class="table table-hover align-middle">
                              <thead class="table-light">
                                    <tr>
                                          <th>ID</th>
                                          <th>Title</th>
                                          <th>Date & Time</th>
                                          <th>Location</th>
                                          <th>Category</th>
                                          @if (session('role') === 'admin')
                                          <th>Actions</th>
                                          @endif
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                          <td>{{ $event->id }}</td>
                                          <td>{{ $event->title }}</td>
                                          <td>{{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}</td>
                                          <td>{{ $event->location }}</td>
                                          <td>{{ $event->category }}</td>

                                          @if (session('role') === 'admin')
                                          <td class="action-buttons">
                                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                          </td>
                                          @endif
                                    </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>

                  {{-- PAGINATION --}}
                  <div class="mt-4">
                        {{ $events->links() }}
                  </div>

            </div>
      </div>

</div>
@endsection