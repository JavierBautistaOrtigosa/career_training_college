@extends('layouts.app')

@section('content')

<h1 class="mb-4 fw-bold">Events</h1>

<div class="card shadow-sm rounded-3 mb-4">
      <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="mb-0 fw-semibold">Event Records</h5>

                  <div class="d-flex align-items-center">
                        <a href="{{ route('events.cards') }}" class="btn btn-outline-secondary btn-sm me-2">
                              Card View
                        </a>

                        {{-- Admin sees real button, user sees invisible placeholder --}}
                        @if (session('role') === 'admin')
                        <a href="{{ route('events.create') }}" class="btn btn-outline-primary btn-sm">
                              Add Event
                        </a>
                        @else
                        <button class="btn btn-outline-primary btn-sm d-none">
                              Add Event
                        </button>
                        @endif
                  </div>
            </div>

            <div class="table-responsive border rounded-3 overflow-hidden">
                  <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                              <tr>
                                    <th class="fw-semibold px-3">ID</th>
                                    <th class="fw-semibold px-3">Title</th>
                                    <th class="fw-semibold px-3">Date & Time</th>
                                    <th class="fw-semibold px-3">Location</th>
                                    <th class="fw-semibold px-3">Category</th>

                                    {{-- Always include Actions column --}}
                                    @if (session('role') === 'admin')
                                    <th class="text-end fw-semibold px-3">Actions</th>
                                    @else
                                    <th class="px-3"></th>
                                    @endif
                              </tr>
                        </thead>

                        <tbody>
                              @foreach ($events as $event)
                              <tr>
                                    <td class="px-3">{{ $event->id }}</td>
                                    <td class="px-3">{{ $event->title }}</td>
                                    <td class="px-3">
                                          {{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}
                                    </td>
                                    <td class="px-3">{{ $event->location }}</td>
                                    <td class="px-3">{{ $event->category }}</td>

                                    {{-- Always include Actions cell --}}
                                    @if (session('role') === 'admin')
                                    <td class="px-3 text-end">
                                          <div class="d-inline-flex gap-2">

                                                <a href="{{ route('events.edit', $event->id) }}"
                                                      class="btn btn-outline-warning btn-sm">
                                                      Edit
                                                </a>

                                                <form action="{{ route('events.destroy', $event->id) }}"
                                                      method="POST" style="display:inline;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="btn btn-outline-danger btn-sm">
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
</div>


@endsection