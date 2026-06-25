<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @yield('pagetitle')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:        #0d1117;
      --surface:   #161b22;
      --border:    #30363d;
      --accent:    #58a6ff;
      --accent-glow: rgba(88,166,255,0.18);
      --text:      #e6edf3;
      --muted:     #8b949e;
      --danger:    #f85149;
      --success:   #3fb950;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    /* Ambient background glow */
    body::before {
      content: '';
      position: fixed;
      top: -30%;
      left: -20%;
      width: 60%;
      height: 60%;
      background: radial-gradient(circle, rgba(88,166,255,0.07) 0%, transparent 70%);
      pointer-events: none;
    }
    body::after {
      content: '';
      position: fixed;
      bottom: -30%;
      right: -20%;
      width: 50%;
      height: 50%;
      background: radial-gradient(circle, rgba(63,185,80,0.05) 0%, transparent 70%);
      pointer-events: none;
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 1.5rem;
      position: relative;
      z-index: 1;
    }

    .brand {
      text-align: center;
      margin-bottom: 2rem;
    }
    .brand-icon {
      width: 52px;
      height: 52px;
      background: var(--accent-glow);
      border: 1px solid rgba(88,166,255,0.3);
      border-radius: 14px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      font-size: 1.4rem;
      color: var(--accent);
    }
    .brand-name {
      font-size: 1.4rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      color: var(--text);
    }
    .brand-sub {
      font-size: 0.8rem;
      color: var(--muted);
      margin-top: 0.2rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }

    .card-heading {
      margin-bottom: 1.75rem;
    }
    .card-heading h2 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--text);
    }
    .card-heading p {
      font-size: 0.85rem;
      color: var(--muted);
      margin-top: 0.25rem;
    }

    .form-group { margin-bottom: 1.1rem; }

    label {
      display: block;
      font-size: 0.8rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 0.4rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    .input-wrap {
      position: relative;
    }
    .input-wrap i {
      position: absolute;
      left: 0.9rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.85rem;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 0.65rem 0.9rem 0.65rem 2.4rem;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      color: var(--text);
      font-size: 0.9rem;
      font-family: 'Inter', sans-serif;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }
    input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-glow);
    }
    input.is-invalid { border-color: var(--danger); }
    .invalid-feedback {
      font-size: 0.78rem;
      color: var(--danger);
      margin-top: 0.3rem;
      display: block;
    }

    .btn-primary {
      width: 100%;
      padding: 0.7rem;
      background: var(--accent);
      color: #0d1117;
      border: none;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      margin-top: 0.5rem;
      transition: opacity 0.2s, box-shadow 0.2s;
      letter-spacing: 0.02em;
    }
    .btn-primary:hover {
      opacity: 0.88;
      box-shadow: 0 0 16px rgba(88,166,255,0.35);
    }

    .form-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1.1rem;
    }
    .form-footer a {
      font-size: 0.82rem;
      color: var(--accent);
      text-decoration: none;
    }
    .form-footer a:hover { text-decoration: underline; }

    .divider {
      text-align: center;
      margin: 1.25rem 0;
      position: relative;
      color: var(--muted);
      font-size: 0.78rem;
    }
    .divider::before, .divider::after {
      content: '';
      position: absolute;
      top: 50%;
      width: 42%;
      height: 1px;
      background: var(--border);
    }
    .divider::before { left: 0; }
    .divider::after { right: 0; }

    .register-link {
      text-align: center;
      font-size: 0.83rem;
      color: var(--muted);
      margin-top: 1.25rem;
    }
    .register-link a { color: var(--accent); text-decoration: none; }
    .register-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="brand">
      <div class="brand-icon"><i class="fa-solid fa-code-branch"></i></div>
      <div class="brand-name">{{ env('APP_NAME') }}</div>
      <div class="brand-sub">IT Management System</div>
    </div>
    <div class="card">
      @yield('content')
    </div>
  </div>
</body>
</html>
