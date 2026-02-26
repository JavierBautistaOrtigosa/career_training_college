<!DOCTYPE html>
<html>

<head>
      <title>Career Training College</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                  <a class="navbar-brand" href="{{ route('members.index') }}">Career Training College</a>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">

                              <li class="nav-item">
                                    <a class="nav-link" href="{{ route('members.index') }}">Members</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link" href="{{ route('events.index') }}">Events</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}">About</a>
                              </li>


                        </ul>

                        <ul class="navbar-nav">
                              <li class="nav-item">
                                    <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
                              </li>
                        </ul>

                  </div>
            </div>
      </nav>



      @yield('content')

</body>

</html>