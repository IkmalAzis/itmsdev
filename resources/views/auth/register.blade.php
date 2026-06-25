@extends('layouts.login')

@section('pagetitle')
  <title>Register — ITMS</title>
@endsection

@section('content')
<div class="card-heading">
  <h2>Create account</h2>
  <p>Fill in your details to get started.</p>
</div>

<form method="POST" action="{{ route('register') }}">
  @csrf

  {{-- Row 1: Name + Phone --}}
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem">
    <div class="form-group">
      <label for="name">Full Name</label>
      <div class="input-wrap">
        <i class="fa-regular fa-user"></i>
        <input id="name" type="text" name="name"
          class="@error('name') is-invalid @enderror"
          value="{{ old('name') }}" required autofocus placeholder="Your name">
      </div>
      @error('name')
        <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="phonenum">Phone</label>
      <div class="input-wrap">
        <i class="fa-solid fa-phone"></i>
        <input id="phonenum" type="text" name="phonenum"
          class="@error('phonenum') is-invalid @enderror"
          value="{{ old('phonenum') }}" required placeholder="01x-xxxxxxx">
      </div>
      @error('phonenum')
        <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
      @enderror
    </div>
  </div>

  {{-- Row 2: Business Unit + Email --}}
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem">
    <div class="form-group">
      <label for="bunit">Business Unit</label>
      <div class="input-wrap">
        <i class="fa-solid fa-building"></i>
        <select name="bunit" id="bunit" style="
          width:100%; padding:0.65rem 0.9rem 0.65rem 2.4rem;
          background:var(--bg); border:1px solid var(--border);
          border-radius:8px; color:var(--text); font-size:0.88rem;
          font-family:'Inter',sans-serif; outline:none; appearance:none;">
          <option value="">-- Select --</option>
          <option value="ITMS" {{ old('bunit') == 'ITMS' ? 'selected' : '' }}>ITMS</option>
          <option value="CCI"  {{ old('bunit') == 'CCI'  ? 'selected' : '' }}>CCI</option>
          <option value="COE"  {{ old('bunit') == 'COE'  ? 'selected' : '' }}>COE</option>
          <option value="COBA" {{ old('bunit') == 'COBA' ? 'selected' : '' }}>COBA</option>
          <option value="COGS" {{ old('bunit') == 'COGS' ? 'selected' : '' }}>COGS</option>
        </select>
      </div>
      @error('bunit')
        <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <div class="input-wrap">
        <i class="fa-regular fa-envelope"></i>
        <input id="email" type="email" name="email"
          class="@error('email') is-invalid @enderror"
          value="{{ old('email') }}" required placeholder="you@email.com">
      </div>
      @error('email')
        <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
      @enderror
    </div>
  </div>

  {{-- Row 3: Password + Confirm --}}
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem">
    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock"></i>
        <input id="password" type="password" name="password"
          class="@error('password') is-invalid @enderror"
          required placeholder="Min 8 chars">
      </div>
      @error('password')
        <span class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="password-confirm">Confirm</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock"></i>
        <input id="password-confirm" type="password"
          name="password_confirmation" required placeholder="Repeat password">
      </div>
    </div>
  </div>

  <button type="submit" class="btn-primary">Create Account</button>
</form>

<div class="register-link" style="margin-top:1rem;">
  Already have an account? <a href="{{ route('login') }}">Sign in</a>
</div>
@endsection
