@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <h1 class="page-header fw-bold heading-tight">Events (Card View)</h1>

      <div class="card-premium card-hover rounded-3">
            <div class="card-body p-4 p-tight">

                  {{-- HEADER --}}
                  <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-semibold heading-tight mb-0">Events (Card View)</h2>

                        <div class="action-buttons">
                              <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Table View</a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('events.create') }}" class="btn btn-green">+ Add New Event</a>
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

                        <div class="col-12 d-flex justify-content-end action-buttons">
                              <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                              <button class="btn btn-green btn-sm">Apply</button>
                        </div>

                  </form>

                  {{-- CARD GRID --}}
                  <div class="row g-3">
                        @foreach($events as $event)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                              <div class="card card-hover h-100 d-flex flex-column">

                                    {{-- IMAGE --}}
                                    @if($event->image_path)
                                    <img src="{{ asset('storage/' . $event->image_path) }}"
                                          class="card-img-top object-fit-cover"
                                          style="height: 180px;"
                                          alt="Event Image">
                                    @else
                                    <img src="{{ asset('images/event_placeholder_1.jpg') }}"
                                          class="card-img-top object-fit-cover"
                                          style="height: 180px;"
                                          alt="Placeholder Image">
                                    @endif

                                    {{-- BODY --}}
                                    <div class="card-body p-3 p-tight d-flex flex-column">

                                          <h5 class="fw-semibold mb-2 heading-tight text-truncate-2">
                                                {{ $event->title }}
                                          </h5>

                                          <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}</p>

                                          <p class="text-truncate-3">
                                                <strong>Description:</strong> {{ $event->description }}
                                          </p>

                                          <p><strong>Location:</strong> {{ $event->location }}</p>

                                          @if (session('role') === 'admin')
                                          <div class="action-buttons mt-auto pt-2">
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