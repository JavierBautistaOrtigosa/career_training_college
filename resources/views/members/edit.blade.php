@extends('layouts.app')

@section('content')
<div class="container">
      <h1>Edit Member</h1>

      <form action="{{ route('members.update', $member->id) }}" method="POST"> @csrf @method('PUT')

            <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" name="first_name" class="form-control" value="{{ $member->first_name }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="{{ $member->last_name }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Age</label>
                  <input type="number" name="age" class="form-control" value="{{ $member->age }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $member->email }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" value="{{ $member->phone }}" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" value="{{ $member->address }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Member</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
</div>
@endsection