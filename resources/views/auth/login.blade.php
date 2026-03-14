@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

      <div class="login-card p-4 rounded-4 shadow-sm">


            {{-- Logo --}}
            <div class="text-left mb-3">
                  <img src="/images/ctc_logo_v3.svg" alt="CTC Logo" class="login-logo">
            </div>

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

                  <div class="text-end mb-3">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                  </div>

                  <button type="submit" class="btn btn-green w-100 py-2 fw-semibold">
                        Login
                  </button>
            </form>

      </div>

</div>
@endsection