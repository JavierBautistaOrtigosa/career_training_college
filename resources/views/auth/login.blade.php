<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login - Career Training College</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="login-page">

      <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="login-card" style="width: 420px;">

                  {{-- Logo --}}
                  <div class="text-center mb-3">
                        <img src="/images/ctc_logo_v1.svg" alt="CTC Logo" class="login-logo">
                  </div>

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

                        <div class="mb-2">
                              <label class="form-label fw-semibold">Password</label>
                              <input type="password" name="password" class="form-control" required>
                        </div>

                        {{-- Optional Forgot Password --}}
                        <div class="text-end mb-3">
                              <a href="#" class="forgot-link">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-green w-100 py-2 fw-semibold">
                              Login
                        </button>
                  </form>

            </div>

      </div>

</body>

</html>