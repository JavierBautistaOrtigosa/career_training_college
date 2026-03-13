@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <div class="card main-card rounded-3">
            <div class="card-body p-4">

                  {{-- HEADER --}}
                  <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold heading-tight mb-0">Members (Card View)</h2>

                        <div class="d-flex gap-2">
                              <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                                    Table View
                              </a>

                              @if (session('role') === 'admin')
                              <a href="{{ route('members.create') }}" class="btn btn-outline-success">
                                    + Add New Member
                              </a>
                              @endif
                        </div>
                  </div>


                  {{-- FILTERS --}}
                  <form method="GET" action="{{ route('members.cards') }}" class="row g-3 mb-4">

                        <div class="col-md-4">
                              <label class="form-label fw-semibold">Search Name</label>
                              <input type="text" name="search" class="form-control"
                                    placeholder="Search first or last name..."
                                    value="{{ request('search') }}">
                        </div>

                        <div class="col-md-4">
                              <label class="form-label fw-semibold">Email</label>
                              <input type="text" name="email" class="form-control"
                                    placeholder="Search email..."
                                    value="{{ request('email') }}">
                        </div>

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

                        <div class="col-12 d-flex justify-content-end gap-2">
                              <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                              <button class="btn btn-primary btn-sm">Apply</button>
                        </div>

                  </form>

                  {{-- CARD GRID --}}
                  <div class="row g-3">
                        @foreach($members as $member)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                              <div class="card card-hover shadow-sm rounded-3 h-100 p-tight">

                                    <div class="card-body p-3">
                                          <h5 class="fw-bold mb-2 heading-tight">
                                                {{ $member->first_name }} {{ $member->last_name }}
                                          </h5>

                                          <p><strong>Email:</strong> {{ $member->email }}</p>
                                          <p><strong>Age:</strong> {{ $member->age }}</p>

                                          @if (session('role') === 'admin')
                                          <div class="action-buttons mt-3">
                                                <a href="{{ route('members.edit', $member->id) }}"
                                                      class="btn btn-outline-primary btn-sm w-50">Edit</a>

                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="w-50">
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
                        {{ $members->links() }}
                  </div>

            </div>
      </div>

</div>
@endsection