<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Career Training College</title>

      {{-- CTC FAVICON --}}
      <link rel="icon" type="image/svg+xml" href="{{ asset('images/ctc_favicon.svg') }}">

      {{-- BOOTSTRAP CSS --}}
      <link
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css?v=20260311"
            rel="stylesheet">

      {{-- CUSTOM CSS (general styles) --}}
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

      {{-- CUSTOM UI CSS (premium UI styling) --}}
      <link rel="stylesheet" href="{{ asset('css/ui.css') }}">

      {{-- BOOTSTRAP ICONS --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

      {{-- FILTER TOGGLE LOGIC (JS) --}}
      <script src="{{ asset('js/app.js') }}"></script>

      {{-- PREVENT AGGRESSIVE CACHING --}}
      <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">
</head>

{{-- PURE BOOTSTRAP STICKY FOOTER LAYOUT --}}

<body class="action-buttons flex-column min-vh-100 bg-premium-dark">

      {{-- NAVBAR --}}
      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container">

                  {{-- LOGO (LEFT) --}}
                  <a class="navbar-brand d-flex align-items-center fw-semibold" href="{{ route('members.index') }}">
                        <img src="{{ asset('images/ctc_logo_v1.svg') }}" alt="CTC Logo" height="36" class="me-2">
                  </a>

                  {{-- MOBILE TOGGLER --}}
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                  </button>

                  {{-- NAV LINKS --}}
                  <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">

                              {{-- HOME --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('members.index') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('members.index') }}">
                                          Home
                                    </a>
                              </li>

                              {{-- EVENTS --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('events.index') }}">
                                          Events
                                    </a>
                              </li>

                              {{-- CREATE MEMBER --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('members.create') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('members.create') }}">
                                          Create Member
                                    </a>
                              </li>

                              {{-- CREATE EVENT --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('events.create') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('events.create') }}">
                                          Create Event
                                    </a>
                              </li>

                              {{-- ABOUT US --}}
                              <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}"
                                          href="{{ route('about') }}">
                                          About Us
                                    </a>
                              </li>

                              {{-- LOGOUT BUTTON --}}
                              <li class="nav-item ms-lg-3">
                                    <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}">
                                          Logout
                                    </a>
                              </li>
                        </ul>
                  </div>
            </div>
      </nav>

      {{-- MAIN CONTENT AREA (flex-grow pushes footer down) --}}
      <main class="flex-grow-1">
            <div class="container my-4">
                  @yield('content')
            </div>
      </main>

      {{-- FOOTER --}}
      @include('partials.footer')

      {{-- DISABLE BFCACHE (prevents stale pages on back button) --}}
      <script>
            window.addEventListener("pageshow", function(event) {
                  if (event.persisted) {
                        window.location.reload();
                  }
            });
      </script>

      {{-- BOOTSTRAP JS --}}
      <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js">
      </script>

</body>

</html>