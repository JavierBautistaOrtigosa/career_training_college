@extends('layouts.app')

@section('content')
<div class="container mt-4">

      {{-- MAIN CARD (header + filters + cards + pagination) --}}
      <div class="card-premium card-hover rounded-3">
            <div class="card-body p-3">

                  {{-- HEADER + TOP TOOLBAR --}}
                  <!-- <div class="d-flex flex-lg-row flex-column justify-content-between align-items-lg-center mb-3">

                        {{-- LEFT: TITLE --}}
                        <h4 class="fw-semibold mb-2 mb-lg-0">Members cards</h4>

                        {{-- RIGHT: BUTTONS --}}
                        <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">

                              <button type="button" id="toggleFilters"
                                    class="btn btn-outline-secondary rounded-3">
                                    Filters
                              </button>

                              <a href="{{ route('members.index') }}" class="btn btn-outline-secondary rounded-3">
                                    Table View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('members.create') }}" class="btn btn-green rounded-3">
                                    + Add New Member
                              </a>
                              @endif

                        </div>

                  </div> -->
                  <!-- <div class="d-flex flex-lg-row flex-column justify-content-between align-items-lg-center mb-3">

                        <h4 class="fw-semibold mb-2 mb-lg-0">Members list</h4>

                        <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">

                              <button type="button" id="toggleFilters"
                                    class="btn btn-outline-secondary rounded-3">
                                    Filters
                              </button>

                              <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary rounded-3">
                                    Card View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('members.create') }}" class="btn btn-green rounded-3">
                                    + Add New Member
                              </a>
                              @endif

                        </div>

                  </div> -->
                  <div class="d-flex flex-lg-row flex-column justify-content-between align-items-lg-center mb-3 w-100">

                        <h4 class="fw-semibold mb-2 mb-lg-0">Members list</h4>

                        <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">

                              <button type="button" id="toggleFilters"
                                    class="btn btn-outline-secondary rounded-3">
                                    Filters
                              </button>

                              <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary rounded-3">
                                    Card View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('members.create') }}" class="btn btn-green rounded-3">
                                    + Add New Member
                              </a>
                              @endif

                        </div>

                  </div>




                  {{-- FILTERS --}}
                  <form method="GET" action="{{ route('members.cards') }}">

                        <!-- <div id="filtersContainer" class="row g-2 mb-3 d-none"> -->
                        <div id="filtersContainer" class="row g-2 mb-3">

                              {{-- SEARCH NAME --}}
                              <div class="col-md-4">
                                    <label class="form-label fw-semibold">Search Name</label>
                                    <input type="text" name="search" class="form-control"
                                          placeholder="Search first or last name..."
                                          value="{{ request('search') }}">
                              </div>

                              {{-- EMAIL --}}
                              <div class="col-md-4">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="text" name="email" class="form-control"
                                          placeholder="Search email..."
                                          value="{{ request('email') }}">
                              </div>

                              {{-- SORT BY --}}
                              <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort By</label>
                                    <select name="sort" class="form-select">
                                          <option value="">Default (ID Asc)</option>
                                          <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID: Ascending</option>
                                          <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID: Descending</option>
                                          <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A → Z</option>
                                          <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z → A</option>
                                    </select>
                              </div>

                              {{-- RESET + APPLY --}}
                              <div class="col-12 text-end">

                                    <a href="{{ route('members.cards') }}"
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

                  {{-- CARD GRID --}}
                  <div class="row g-3">
                        @foreach($members as $member)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                              <div class="card card-hover h-100 d-flex flex-column">

                                    <div class="card-body p-3 d-flex flex-column">

                                          <h5 class="fw-semibold mb-2 heading-tight text-truncate-2">
                                                {{ $member->first_name }} {{ $member->last_name }}
                                          </h5>

                                          <p class="text-truncate-2"><strong>Email:</strong> {{ $member->email }}</p>
                                          <p><strong>Age:</strong> {{ $member->age }}</p>

                                          @if (session('role') === 'admin')
                                          <div class="action-buttons mt-auto pt-2 d-flex gap-2">

                                                <a href="{{ route('members.edit', $member->id) }}"
                                                      class="btn btn-outline-primary btn-sm w-50">Edit</a>

                                                <form action="{{ route('members.destroy', $member->id) }}"
                                                      method="POST" class="w-50">
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
                  <div class="mt-4 pt-3 border-top pb-0 mb-0 d-flex justify-content-center">
                        <div class="my-paginator">
                              {{ $members->links() }}
                        </div>
                  </div>


            </div>
      </div>

</div>



@endsection