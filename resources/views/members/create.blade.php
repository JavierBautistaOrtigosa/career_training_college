@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Add New Member</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            <form action="{{ route('members.store') }}" method="POST">
                  @csrf

                  <div class="mb-3">
                        <label class="form-label fw-semibold">First Name</label>
                        <input
                              type="text"
                              name="first_name"
                              class="form-control"
                              placeholder="Enter first name"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input
                              type="text"
                              name="last_name"
                              class="form-control"
                              placeholder="Enter last name"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Age</label>
                        <input
                              type="number"
                              name="age"
                              class="form-control"
                              placeholder="Enter age"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input
                              type="email"
                              name="email"
                              class="form-control"
                              placeholder="Enter email address"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input
                              type="text"
                              name="phone"
                              class="form-control"
                              placeholder="Enter phone number"
                              required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <input
                              type="text"
                              name="address"
                              class="form-control"
                              placeholder="Enter address"
                              required>
                  </div>

                  <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                              Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                              Save Member
                        </button>

                  </div>

            </form>

      </div>
</div>

@endsection