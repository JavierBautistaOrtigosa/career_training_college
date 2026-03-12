<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login - Career Training College</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

      <div class="container-fluid">
            <div class="row" style="min-height: 100vh;">

                  {{-- LEFT SIDE — WELCOME MESSAGE WITH FULL BACKGROUND IMAGE --}}
                  <div class="col-md-6 position-relative p-0">

                        {{-- Background image --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                              style="
            background-image: url('/images/welcome-bg.jpg');
            background-size: cover;
            background-position: center;
         ">
                        </div>

                        {{-- Dark overlay for readability --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                              style="background: rgba(0, 0, 0, 0.45);">
                        </div>

                        {{-- Text content --}}
                        <div class="position-relative p-5 text-white d-flex flex-column justify-content-center"
                              style="min-height: 100vh;">

                              <h1 class="fw-bold mb-3">Welcome to the CTC Management App</h1>

                              <p class="fs-5 mb-4" style="max-width: 480px;">
                                    This system helps you manage members, events, and daily operations
                                    quickly and efficiently.
                              </p>

                              <p class="small mt-4">
                                    Career Training College — Internal System
                              </p>

                        </div>

                  </div>

                  {{-- RIGHT SIDE — LOGIN FORM --}}
                  <div class="col-md-6 d-flex justify-content-center align-items-center bg-light p-5">

                        <div class="card shadow-sm rounded-3 p-4" style="width: 420px;">

                              <h2 class="fw-bold mb-4 text-center">Login</h2>

                              @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                              @endif

                              @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                              @endif

                              <form action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                          <label class="form-label fw-semibold">Email</label>
                                          <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                          <label class="form-label fw-semibold">Password</label>
                                          <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 mt-3">
                                          Login
                                    </button>
                              </form>

                        </div>

                  </div>

            </div>
      </div>

</body>

</html>