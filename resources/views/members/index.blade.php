@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Members</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="mb-0 fw-semibold">Member Records</h5>
                  <a href="{{ route('members.create') }}" class="btn btn-outline-success">
                        + Add New Member
                  </a>

            </div>

            <div class="table-responsive border rounded-3 overflow-hidden">
                  <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                              <tr>
                                    <th class="fw-semibold px-3">ID</th>
                                    <th class="fw-semibold px-3">Full Name</th>
                                    <th class="fw-semibold px-3">Email</th>
                                    <th class="fw-semibold px-3">Phone</th>
                                    <th class="text-end fw-semibold px-3">Actions</th>
                              </tr>
                        </thead>

                        <tbody>
                              @foreach ($members as $member)
                              <tr>
                                    <td class="px-3">{{ $member->id }}</td>
                                    <td class="px-3">{{ $member->full_name }}</td>
                                    <td class="px-3">{{ $member->email }}</td>
                                    <td class="px-3">{{ $member->phone }}</td>

                                    <td class="px-3 text-end">
                                          <div class="d-inline-flex gap-2">
                                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-outline-primary btn-sm">
                                                      Edit
                                                </a>

                                                <form action="{{ route('members.destroy', $member->id) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this member?');">
                                                            Delete
                                                      </button>
                                                </form>
                                          </div>
                                    </td>
                              </tr>
                              @endforeach
                        </tbody>

                  </table>
            </div>

      </div>
</div>

@endsection