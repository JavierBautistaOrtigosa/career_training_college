@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <div class="card main-card rounded-3">
            <div class="card-body p-4">

                  {{-- HEADER --}}
                  <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold heading-tight mb-0">Events (Card View)</h2>

                        <div class="d-flex gap-2">
                              <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                                    Table View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('events.create') }}" class="btn btn-outline-success">
                                    + Add New Event
                              </a>
                              @endif
                        </div>
                  </div>


                  {{-- FILTERS --}}
                  <form method="GET" action="{{ route('events.cards') }}" class="row g-3 mb-4">

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

                        <div class="col-12 d-flex justify-content-end gap-2">
                              <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                              <button class="btn btn-primary btn-sm">Apply</button>
                        </div>

                  </form>


                  {{-- CARD GRID --}}
                  <div class="row g-3">
                        @foreach($events as $event)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                              <div class="card card-hover shadow-sm rounded-3 h-100 p-tight">

                                    @if($event->image_path)
                                    <img src="{{ asset('storage/' . $event->image_path) }}"
                                          class="card-img-top"
                                          alt="Event Image">
                                    @else
                                    <div class="bg-light text-center py-5 rounded-top">
                                          <span class="text-muted">No Image</span>
                                    </div>
                                    @endif

                                    <div class="card-body p-3">
                                          <h5 class="fw-bold mb-2 heading-tight">{{ $event->title }}</h5>

                                          <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}</p>
                                          <p><strong>Location:</strong> {{ $event->location }}</p>
                                          <p><strong>Description:</strong> {{ $event->description }}</p>

                                          @if (session('role') === 'admin')
                                          <div class="action-buttons mt-3">
                                                <a href="{{ route('events.edit', $event->id) }}"
                                                      class="btn btn-outline-primary btn-sm w-50">Edit</a>

                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="w-50">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit"
                                                            class="btn btn-outline-danger btn-sm w-100"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                          </div>
                                          @endif

                                    </div>
                              </div>
                        </div>
                        @endforeach
                  </div>

                  {{-- PAGINATION --}}
                  <div class="mt-4">
                        {{ $events->links() }}
                  </div>

            </div>
      </div>

</div>
@endsection