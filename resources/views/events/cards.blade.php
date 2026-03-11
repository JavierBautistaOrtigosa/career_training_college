@extends('layouts.app')

@section('content')
<div class="container mt-4">

      <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Events (Card View)</h2>

            <div>
                  <a href="{{ route('events.index') }}" class="btn btn-outline-secondary me-2">
                        Table View
                  </a>

                  @if (session('role') === 'admin')
                  <a href="{{ route('events.create') }}" class="btn btn-outline-success">
                        + Add New Event
                  </a>
                  @endif
            </div>
      </div>

      <div class="row g-3">
            @foreach($events as $event)
            <div class="col-md-4">
                  <div class="card rounded-3 shadow-sm h-100">

                        @if($event->image_path)
                        <img src="{{ asset('storage/' . $event->image_path) }}"
                              class="card-img-top"
                              alt="Event Image">
                        @else
                        <div class="bg-light text-center py-5 rounded-top">
                              <span class="text-muted">No Image</span>
                        </div>
                        @endif

                        <div class="card-body">
                              <h5 class="card-title fw-bold mb-1">{{ $event->title }}</h5>

                              <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('M j, Y – g:i A') }}</p>
                              <p class="mb-1"><strong>Location:</strong> {{ $event->location }}</p>
                              <p class="mb-1"><strong>Description:</strong> {{ $event->description }}</p>

                              @if (session('role') === 'admin')
                              <div class="mt-3 d-flex gap-2">
                                    <a href="{{ route('events.edit', $event->id) }}"
                                          class="btn btn-outline-primary btn-sm w-50">
                                          Edit
                                    </a>

                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="w-50">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit"
                                                class="btn btn-outline-danger btn-sm w-100"
                                                onclick="return confirm('Are you sure you want to delete this event?')">
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

</div>
@endsection