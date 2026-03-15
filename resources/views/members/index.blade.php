@extends('layouts.app')

@section('content')

{{-- MAIN CARD (filters + buttons + table) --}}
<div class="card-premium card-hover rounded-3">
      <div class="card-body p-3">

            {{-- CARD HEADER + TOP TOOLBAR (ONE ROW) --}}
            <div class="d-flex flex-lg-row flex-column justify-content-between align-items-lg-center mb-3">

                  {{-- LEFT: TITLE --}}
                  <h4 class="fw-semibold mb-2 mb-lg-0">Members list</h4>

                  {{-- RIGHT: BUTTONS --}}
                  <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">

                        {{-- FILTERS TOGGLE BUTTON --}}
                        <button type="button" id="toggleFilters"
                              class="btn btn-outline-secondary rounded-3">
                              Filters
                        </button>

                        {{-- SWITCH TO CARD VIEW --}}
                        <a href="{{ route('members.cards') }}" class="btn btn-outline-secondary rounded-3">
                              Card View
                        </a>

                        {{-- ADMIN: ADD NEW MEMBER --}}
                        @if (session('role') === 'admin')
                        <a href="{{ route('members.create') }}" class="btn btn-green rounded-3">
                              + Add New Member
                        </a>
                        @endif
                  </div>
            </div>

            {{-- START FORM (FILTERS + SORTING) --}}
            <form method="GET" action="{{ route('members.index') }}">

                  {{-- FILTERS ROW --}}
                  <div id="filtersContainer" class="row g-2 mb-3">

                        {{-- SEARCH NAME --}}
                        <div class="col-md-4">
                              <label class="form-label fw-semibold">Search Name</label>
                              <input type="text" name="search" class="form-control"
                                    placeholder="Search first or last name..."
                                    value="{{ request('search') }}">
                        </div>

                        {{-- SEARCH EMAIL --}}
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
                              <a href="{{ route('members.index') }}"
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

            {{-- TABLE WRAPPER --}}
            <div class="table-responsive">
                  <table class="table table-hover table-sm table-borderless">

                        {{-- TABLE HEADER --}}
                        <thead class="border-bottom">
                              <tr>
                                    <th class="pb-2">ID</th>
                                    <th class="pb-2">Name</th>
                                    <th class="pb-2">Email</th>
                                    <th class="pb-2">Age</th>

                                    {{-- ADMIN: ACTIONS COLUMN --}}
                                    @if (session('role') === 'admin')
                                    <th class="pb-2 text-end">Actions</th>
                                    @endif
                              </tr>
                        </thead>

                        {{-- TABLE BODY --}}
                        <tbody>
                              @foreach($members as $member)
                              <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->age }}</td>

                                    {{-- ADMIN ACTION ICONS --}}
                                    @if (session('role') === 'admin')
                                    <td class="text-end">

                                          {{-- EDIT ICON --}}
                                          <a href="{{ route('members.edit', $member->id) }}"
                                                class="action-icon icon-edit me-2">
                                                <i class="bi bi-pencil-square"></i>
                                          </a>

                                          {{-- DELETE ICON --}}
                                          <form action="{{ route('members.destroy', $member->id) }}"
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
                        {{ $members->links() }}
                  </div>
            </div>

      </div>
</div>

@endsection