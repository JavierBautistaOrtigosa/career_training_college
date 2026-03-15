@extends('layouts.app')

@section('content')
<div class="container mt-4">

      {{-- MAIN CARD (filters + buttons + table) --}}
      <div class="card-premium card-hover rounded-3">
            <div class="card-body p-3">

                  {{-- CARD HEADER + TOP TOOLBAR (ONE ROW) --}}
                  <div class="d-flex flex-lg-row flex-column justify-content-between align-items-lg-center mb-3">

                        {{-- LEFT: TITLE --}}
                        <h4 class="fw-semibold mb-2 mb-lg-0">Events list</h4>

                        {{-- RIGHT: BUTTONS --}}
                        <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">

                              {{-- FILTERS TOGGLE BUTTON --}}
                              <button type="button" id="toggleFilters"
                                    class="btn btn-outline-secondary rounded-3">
                                    Filters
                              </button>

                              {{-- SWITCH TO CARD VIEW --}}
                              <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary rounded-3">
                                    Card View
                              </a>

                              {{-- ADMIN: ADD NEW EVENT --}}
                              @if (session('role') === 'admin')
                              <a href="{{ route('events.create') }}" class="btn btn-green rounded-3">
                                    + Add New Event
                              </a>
                              @endif
                        </div>
                  </div>


                  {{-- START FORM (FILTERS + SORTING) --}}
                  <form method="GET" action="{{ route('events.index') }}">

                        {{-- FILTERS ROW (INCLUDING RESET + APPLY) --}}
                        <div id="filtersContainer" class="row g-2 mb-3">

                              {{-- SEARCH TITLE --}}
                              <div class="col-md-3">
                                    <label class="form-label fw-semibold">Search Title</label>
                                    <input type="text" name="search" class="form-control"
                                          placeholder="Search event title..."
                                          value="{{ request('search') }}">
                              </div>

                              {{-- CATEGORY --}}
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

                              {{-- LOCATION --}}
                              <div class="col-md-3">
                                    <label class="form-label fw-semibold">Location</label>
                                    <input type="text" name="location" class="form-control"
                                          placeholder="Search location..."
                                          value="{{ request('location') }}">
                              </div>

                              {{-- SORT BY --}}
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

                              {{-- RESET + APPLY BUTTONS --}}
                              <div class="col-12 text-end">
                                    <a href="{{ route('events.index') }}"
                                          class="btn btn-outline-secondary rounded-3 d-inline-flex align-items-center gap-1">
                                          <i class="bi bi-arrow-counterclockwise"></i>
                                          Reset
                                    </a>
                                    <button class="btn btn-outline-primary rounded-3 d-inline-flex align-items-center gap-1">
                                          <i class="bi bi-check2"></i>
                                          Apply
                                    </button>
                              </div>
                        </div>
                  </form>
                  {{-- END FORM --}}

                  {{-- TABLE WRAPPER --}}
                  <div class="table-responsive">
                        <table class="table table-hover table-sm table-borderless">

                              {{-- TABLE HEADER --}}
                              <thead class="border-bottom">
                                    <tr>
                                          <th class="pb-2">ID</th>
                                          <th class="pb-2">Title</th>
                                          <th class="pb-2">Date & Time</th>
                                          <th class="pb-2">Location</th>
                                          <th class="pb-2">Category</th>

                                          {{-- ADMIN: ACTIONS COLUMN --}}
                                          @if (session('role') === 'admin')
                                          <th class="pb-2 text-end">Actions</th>
                                          @endif
                                    </tr>
                              </thead>

                              {{-- TABLE BODY --}}
                              <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                          <td>{{ $event->id }}</td>
                                          <td>{{ $event->title }}</td>
                                          <td>{{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}</td>
                                          <td>{{ $event->location }}</td>
                                          <td>{{ $event->category }}</td>

                                          {{-- ADMIN ACTION ICONS --}}
                                          @if (session('role') === 'admin')
                                          <td class="text-end">

                                                {{-- EDIT ICON --}}
                                                <a href="{{ route('events.edit', $event->id) }}"
                                                      class="action-icon icon-edit me-2">
                                                      <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- DELETE ICON --}}
                                                <form action="{{ route('events.destroy', $event->id) }}"
                                                      method="POST" class="d-inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="action-icon icon-delete"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i>
                                                      </button>
                                                </form>

                                          </td>
                                          @endif
                                    </tr>
                                    @endforeach
                              </tbody>

                        </table>
                  </div>

                  {{-- PAGINATION --}}
                  <div class="mt-0 pt-3 border-top pb-0 mb-0 d-flex justify-content-center">
                        <div class="my-paginator">
                              {{ $events->links() }}
                        </div>
                  </div>

            </div>
      </div>
</div>
@endsection