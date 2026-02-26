@extends('layouts.app')

@section('content')
<div class="container">
      <h1>Add New Member</h1>

      <form action="{{ route('members.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Age</label>
                  <input type="number" name="age" class="form-control" required>
            </div>

            <div class="mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Save Member</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
</div>
@endsection