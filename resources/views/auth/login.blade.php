@extends('layouts.login')

@section('pagetitle')
  <title>Sign In — ITMS</title>
@endsection

@section('content')
<div class="card-heading">
  <h2>Welcome back</h2>
  <p>Sign in to your account to continue.</p>
</div>

<form method="POST" action="{{ route('login') }}">
  @csrf

  <div class="form-group">
    <label for="email">Email Address</label>
    <div class="input-wrap">
      <i class="fa-regular fa-envelope"></i>
      <input id="email" type="email" name="email"
        class="@error('email') is-invalid @enderror"
        value="{{ old('email') }}" required autocomplete="email">
    </div>
    @error('email')
      <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <div class="input-wrap">
      <i class="fa-solid fa-lock"></i>
      <input id="password" type="password" name="password"
        class="@error('password') is-invalid @enderror"
        required autocomplete="current-password">
    </div>
    @error('password')
      <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
    @enderror
  </div>

  <button type="submit" class="btn-primary">Sign In</button>

  <div class="form-footer">
    @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}">Forgot password?</a>
    @endif
  </div>
</form>

<div class="register-link">
  Don't have an account? <a href="{{ route('register') }}">Create one</a>
</div>
@endsection
