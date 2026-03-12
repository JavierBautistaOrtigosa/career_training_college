@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Edit Member</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            <form action="{{ route('members.update', $member->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Member ID</label>
                        <input
                              type="text"
                              class="form-control"
                              value="{{ $member->id }}"
                              readonly>
                  </div>


                  <div class="mb-3">
                        <label class="form-label fw-semibold">First Name</label>
                        <input
                              type="text"
                              name="first_name"
                              class="form-control"
                              value="{{ $member->first_name }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input
                              type="text"
                              name="last_name"
                              class="form-control"
                              value="{{ $member->last_name }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Age</label>
                        <input
                              type="number"
                              name="age"
                              class="form-control"
                              value="{{ $member->age }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input
                              type="email"
                              name="email"
                              class="form-control"
                              value="{{ $member->email }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input
                              type="text"
                              name="phone"
                              class="form-control"
                              value="{{ $member->phone }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <input
                              type="text"
                              name="address"
                              class="form-control"
                              value="{{ $member->address }}"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Professional Summary</label>
                        <textarea
                              name="professional_summary"
                              class="form-control"
                              rows="3">{{ $member->professional_summary }}</textarea>
                  </div>


                  <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                              Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                              Update Member
                        </button>
                  </div>

            </form>

      </div>
</div>

@endsection