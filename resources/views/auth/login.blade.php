<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login - Career Training College</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

      <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-sm rounded-3" style="width: 420px;">
                  <div class="card-body p-4">

                        <h2 class="fw-bold mb-4 text-center">Login</h2>

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

</body>

</html>