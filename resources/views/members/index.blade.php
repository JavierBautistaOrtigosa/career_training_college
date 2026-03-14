@extends('layouts.app')

@section('content')
<div class="container mt-4">

      {{-- PAGE HEADER --}}
      <h1 class="page-header fw-bold heading-tight">Members</h1>

      {{-- MODULE HEADER --}}
      <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold heading-tight mb-0">Members</h2>

            <div class="action-buttons">
                  <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary">Card View</a>

                  @if (session('role') === 'admin')
                  <a href="{{ route('members.create') }}" class="btn btn-green">+ Add New Member</a>
                  @endif
            </div>
      </div>

      {{-- FILTER BAR (wrapped in its own card) --}}
      <div class="card-premium card-hover rounded-3 mb-4">
            <div class="card-body p-1 p-tight">

                  <form method="GET" action="{{ route('members.index') }}" class="row g-2">

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Search Name</label>
                              <input type="text" name="search" class="form-control"
                                    placeholder="Search first or last name..."
                                    value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Email</label>
                              <input type="text" name="email" class="form-control"
                                    placeholder="Search email..."
                                    value="{{ request('email') }}">
                        </div>

                        <div class="col-md-3">
                              <label class="form-label fw-semibold">Sort By</label>
                              <select name="sort" class="form-select">
                                    <option value="">Default (ID Asc)</option>
                                    <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID: Ascending</option>
                                    <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID: Descending</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A → Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z → A</option>
                              </select>
                        </div>

                        {{-- BUTTONS INLINE WITH FILTERS --}}
                        <div class="col-md-3 d-flex align-items-end justify-content-end gap-2">

                              <a href="{{ route('members.index') }}"
                                    class="btn btn-outline-secondary w-100 form-control text-center">
                                    Reset
                              </a>

                              <button class="btn btn-primary w-100 form-control text-center">
                                    Apply
                              </button>

                        </div>

                  </form>
            </div>
      </div>



      {{-- CARD BODY (table only) --}}
      <div class="card-premium card-hover rounded-3">
            <div class="card-body p-1 p-tight">

                  {{-- TABLE --}}
                  <div class="table-responsive">
                        <table class="table table-hover table-sm table-borderless">
                              <!-- <table class="table table-hover table-sm align-middle"> -->
                              <thead class="border-bottom">
                                    <tr>
                                          <th class="pb-2">ID</th>
                                          <th class="pb-2">Name</th>
                                          <th class="pb-2">Email</th>
                                          <th class="pb-2">Age</th>
                                          @if (session('role') === 'admin')
                                          <th class="pb-2 text-end">Actions</th>
                                          @endif
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($members as $member)
                                    <tr>
                                          <td>{{ $member->id }}</td>
                                          <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                          <td>{{ $member->email }}</td>
                                          <td>{{ $member->age }}</td>

                                          @if (session('role') === 'admin')
                                          <td class="text-end">
                                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
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

                  <!-- {{-- PAGINATION --}}
                  <div class="mt-2 pt-4 border-top pb-0 mb-0">
                        {{ $members->links() }}
                  </div> -->

                  <!-- <div class="my-paginator">
                        {{ $members->links('pagination::bootstrap-5') }}
                  </div> -->

                  <div class="mt-0 pt-3 border-top pb-0 mb-0 d-flex justify-content-end">
                        <div class="my-paginator">
                              {{ $members->links() }}
                        </div>
                  </div>




            </div>
      </div>

</div>
@endsection