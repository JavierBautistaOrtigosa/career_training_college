@extends('layouts.app')

@section('content')
<div class="container">
      <h1>Members List</h1>

      <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Add Member</a>

      <table class="table table-bordered">
            <thead>
                  <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                  </tr>
            </thead>

            <tbody>
                  @foreach ($members as $member)
                  <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->full_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>
                              <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>

                              <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                          onclick="return confirm('Are you sure you want to delete this member?');">
                                          Delete
                                    </button>
                              </form>

                        </td>
                  </tr>
                  @endforeach
            </tbody>
      </table>
</div>
@endsection