<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Career Training College</title>

      {{-- Bootstrap CSS --}}
      <link
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css?v=20260311"
            rel="stylesheet">

      {{-- Custom CSS (optional, but not needed for sticky footer) --}}
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

      {{-- Custom CSS (optional... Applies a premium feel) --}}
      <link rel="stylesheet" href="{{ asset('css/ui.css') }}">

      {{-- Bootstrap Icons --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">



      {{-- Prevent aggressive caching --}}
      <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">
</head>

{{-- ⭐ PURE BOOTSTRAP STICKY FOOTER --}}

<body class="action-buttons flex-column min-vh-100 bg-premium-dark">

      {{-- NAVBAR --}}
      <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container">

                  <a class="navbar-brand fw-semibold" href="{{ route('members.index') }}">
                        CTC
                  </a>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav me-auto">
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('members.*') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('members.index') }}">
                                          Members
                                    </a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('events.*') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('events.index') }}">
                                          Events
                                    </a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('about') }}">
                                          About
                                    </a>
                              </li>
                        </ul>

                        <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}">
                              Logout
                        </a>

                  </div>
            </div>
      </nav> -->

      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container">

                  {{-- LOGO (left) --}}
                  <a class="navbar-brand d-flex align-items-center fw-semibold" href="{{ route('members.index') }}">
                        <img src="{{ asset('images/ctc_logo_v1.svg') }}" alt="CTC Logo" height="36" class="me-2">
                  </a>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav ms-auto">

                              {{-- Home --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('members.index') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('members.index') }}">
                                          Home
                                    </a>
                              </li>

                              {{-- Events --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('events.index') }}">
                                          Events
                                    </a>
                              </li>

                              {{-- Create Member --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('members.create') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('members.create') }}">
                                          Create Member
                                    </a>
                              </li>

                              {{-- Create Event --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('events.create') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('events.create') }}">
                                          Create Event
                                    </a>
                              </li>

                              {{-- About Us --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('about') }}">
                                          About Us
                                    </a>
                              </li>

                              {{-- Logout --}}
                              <li class="nav-item ms-lg-3">
                                    <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}">
                                          Logout
                                    </a>
                              </li>

                        </ul>

                  </div>
            </div>
      </nav>




      {{-- MAIN CONTENT (fills remaining space) --}}
      <main class="flex-grow-1">
            <div class="container my-4">
                  @yield('content')
            </div>
      </main>

      {{-- FOOTER --}}
      @include('partials.footer')

      {{-- Disable Back/Forward Cache (bfcache) --}}
      <script>
            window.addEventListener("pageshow", function(event) {
                  if (event.persisted) {
                        window.location.reload();
                  }
            });
      </script>

      {{-- Bootstrap JS --}}
      <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js">
      </script>

</body>

</html>