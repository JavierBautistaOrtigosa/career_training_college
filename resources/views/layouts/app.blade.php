<!DOCTYPE html>
<html>

<head>
      <title>Career Training College</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Disable caching -->
      <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">



</head>

<!-- Disable the browser’s Back/Forward Cache (bfcache) -->
<script>
      window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                  window.location.reload();
            }
      });
</script>


<body class="bg-light">

      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container">

                  <a class="navbar-brand fw-bold" href="{{ route('members.index') }}">
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
      </nav>

      <div class="container mt-4">
            @yield('content')
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>