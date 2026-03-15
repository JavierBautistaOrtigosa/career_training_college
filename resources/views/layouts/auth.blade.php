<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title', 'Login') - Career Training College</title>

      {{-- BOOTSTRAP + LOGIN PAGE CSS ONLY --}}
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

{{-- LOGIN PAGE WRAPPER --}}

<body class="login-page">

      {{-- PAGE CONTENT (injected from child views) --}}
      @yield('content')

</body>

</html>