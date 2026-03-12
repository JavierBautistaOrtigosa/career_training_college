@extends('layouts.app')

@section('content')

<!-- {{-- DEBUG --}}
<div style="background: yellow; padding: 10px; font-weight: bold;">
      INDEX BLADE LOADED
</div> -->


<h1 class="mb-4 fw-bold">Members</h1>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ERROR MESSAGES --}}
@if ($errors->any())
<div class="alert alert-danger">
      <strong>Please fix the following errors:</strong>
      <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
      </ul>
</div>
@endif

{{-- MAIN CARD --}}
<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            {{-- HEADER ROW --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="mb-0 fw-semibold">Member Records</h5>

                  <div class="d-flex align-items-center">
                        <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary btn-sm me-2">
                              Card View
                        </a>

                        @if (session('role') === 'admin')
                        <a href="{{ route('members.create') }}" class="btn btn-outline-primary btn-sm">
                              Add Member
                        </a>
                        @else
                        <button class="btn btn-outline-primary btn-sm d-none">Add Member</button>
                        @endif
                  </div>
            </div>

            {{-- FILTERS + SORTING --}}
            <form method="GET" action="{{ route('members.index') }}" class="row g-3 mb-4">

                  {{-- SEARCH: Name --}}
                  <div class="col-md-4">
                        <label class="form-label fw-semibold">Search Name</label>
                        <input type="text" name="search" class="form-control"
                              placeholder="Search first or last name..."
                              value="{{ request('search') }}">
                  </div>

                  {{-- SEARCH: Email --}}
                  <div class="col-md-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="text" name="email" class="form-control"
                              placeholder="Search email..."
                              value="{{ request('email') }}">
                  </div>

                  {{-- SORTING --}}
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

                  {{-- BUTTONS --}}
                  <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('members.index') }}" class="btn btn-outline-secondary btn-sm">
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
                                    <th class="fw-semibold px-3">Full Name</th>
                                    <th class="fw-semibold px-3">Email</th>
                                    <th class="fw-semibold px-3">Phone</th>

                                    @if (session('role') === 'admin')
                                    <th class="text-end fw-semibold px-3">Actions</th>
                                    @else
                                    <th class="px-3"></th>
                                    @endif
                              </tr>
                        </thead>

                        <tbody>
                              @foreach ($members as $member)
                              <tr>
                                    <td class="px-3">{{ $member->id }}</td>
                                    <td class="px-3">{{ $member->full_name }}</td>
                                    <td class="px-3">{{ $member->email }}</td>
                                    <td class="px-3">{{ $member->phone }}</td>

                                    @if (session('role') === 'admin')
                                    <td class="px-3 text-end">
                                          <div class="d-inline-flex gap-2 align-items-center">

                                                <a href="{{ route('members.edit', $member->id) }}"
                                                      class="btn btn-outline-warning btn-sm"
                                                      style="white-space: nowrap;">
                                                      Edit
                                                </a>

                                                <form action="{{ route('members.destroy', $member->id) }}"
                                                      method="POST"
                                                      style="display:inline-block; margin:0; padding:0;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button
                                                            class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this member?');">
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




      </div>
      {{-- PAGINATION (MUST BE OUTSIDE TABLE-RESPONSIVE) --}}
      <div class="mt-4">
            {{ $members->links() }}

      </div>
</div>

@endsection