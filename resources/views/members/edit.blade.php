@extends('layouts.app')

@section('content')

<div class="container mt-4">

      {{-- PAGE HEADER --}}
      <h1 class="page-header fw-bold heading-tight">Edit Member</h1>

      {{-- SUCCESS MESSAGE --}}
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif

      {{-- VALIDATION ERRORS --}}
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

      {{-- MAIN CARD WRAPPER --}}
      <div class="card-premium card-hover rounded-3 mb-4">
            <div class="card-body p-4">

                  {{-- EDIT MEMBER FORM --}}
                  <form action="{{ route('members.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- MEMBER ID (READ-ONLY) --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Member ID</label>
                              <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $member->id }}"
                                    readonly>
                        </div>

                        {{-- FIRST NAME --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">First Name</label>
                              <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    value="{{ $member->first_name }}"
                                    required>
                        </div>

                        {{-- LAST NAME --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Last Name</label>
                              <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    value="{{ $member->last_name }}"
                                    required>
                        </div>

                        {{-- AGE --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Age</label>
                              <input
                                    type="number"
                                    name="age"
                                    class="form-control"
                                    value="{{ $member->age }}"
                                    required>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Email</label>
                              <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ $member->email }}"
                                    required>
                        </div>

                        {{-- PHONE --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Phone</label>
                              <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ $member->phone }}"
                                    required>
                        </div>

                        {{-- ADDRESS --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Address</label>
                              <input
                                    type="text"
                                    name="address"
                                    class="form-control"
                                    value="{{ $member->address }}"
                                    required>
                        </div>

                        {{-- PROFESSIONAL SUMMARY --}}
                        <div class="mb-3">
                              <label class="form-label fw-semibold">Professional Summary</label>
                              <textarea
                                    name="professional_summary"
                                    class="form-control"
                                    rows="3">{{ $member->professional_summary }}</textarea>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="action-buttons justify-content-end gap-2 mt-4">
                              <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                              </a>
                              <button type="submit" class="btn btn-green">
                                    Update Member
                              </button>
                        </div>

                  </form>

            </div>
      </div>

</div>

@endsection