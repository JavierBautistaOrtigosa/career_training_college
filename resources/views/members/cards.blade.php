@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="fw-bold">Members (Card View)</h2>

      <div>
            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary me-2">
                  Table View
            </a>

            @if (session('role') === 'admin')
            <a href="{{ route('members.create') }}" class="btn btn-outline-success">
                  + Add New Member
            </a>
            @endif
      </div>
</div>

{{-- FILTERS + SORTING --}}
<form method="GET" action="{{ route('members.cards') }}" class="row g-3 mb-4">

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
            <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary btn-sm">
                  Reset Filters
            </a>

            <button class="btn btn-primary btn-sm">
                  Apply Filters
            </button>
      </div>

</form>


<div class="row g-3">
      @foreach($members as $member)
      <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">

                  <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">
                              {{ $member->first_name }} {{ $member->last_name }}
                        </h5>

                        <p class="mb-1"><strong>Email:</strong> {{ $member->email }}</p>
                        <p class="mb-1"><strong>Age:</strong> {{ $member->age }}</p>

                        @if (session('role') === 'admin')
                        <div class="mt-3 d-flex gap-2">
                              <a href="{{ route('members.edit', $member->id) }}"
                                    class="btn btn-outline-primary btn-sm w-50">
                                    Edit
                              </a>

                              <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                          class="btn btn-outline-danger btn-sm w-100"
                                          onclick="return confirm('Are you sure you want to delete this member?')">
                                          Delete
                                    </button>
                              </form>
                        </div>
                        @endif

                  </div>
            </div>
      </div>
      @endforeach
</div>

<div class="mt-4">
      {{ $members->links() }}
</div>

@endsection