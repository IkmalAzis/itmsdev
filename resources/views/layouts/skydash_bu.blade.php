<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('pagetitle')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:          #0d1117;
      --surface:     #161b22;
      --surface-2:   #1c2128;
      --border:      #30363d;
      --accent:      #58a6ff;
      --accent-glow: rgba(88,166,255,0.15);
      --text:        #e6edf3;
      --muted:       #8b949e;
      --danger:      #f85149;
      --warning:     #d29922;
      --success:     #3fb950;
      --info:        #388bfd;
      --sidebar-w:   240px;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-w);
      min-height: 100vh;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0;
      z-index: 100;
    }

    .sidebar-brand {
      padding: 1.4rem 1.25rem 1.2rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 0.65rem;
    }
    .sidebar-brand-icon {
      width: 34px; height: 34px;
      background: var(--accent-glow);
      border: 1px solid rgba(88,166,255,0.3);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      color: var(--accent);
      font-size: 0.85rem;
      flex-shrink: 0;
    }
    .sidebar-brand-text { font-size: 0.9rem; font-weight: 700; color: var(--text); letter-spacing: -0.01em; }
    .sidebar-brand-sub  { font-size: 0.68rem; color: var(--muted); letter-spacing: 0.05em; text-transform: uppercase; }

    .sidebar-section {
      padding: 1rem 0.75rem 0.4rem;
      font-size: 0.65rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
    }

    .sidebar-nav { flex: 1; padding: 0.5rem 0.75rem; }

    .nav-item { margin-bottom: 2px; }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      padding: 0.55rem 0.75rem;
      border-radius: 8px;
      color: var(--muted);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      transition: background 0.15s, color 0.15s;
    }
    .nav-link:hover { background: var(--surface-2); color: var(--text); }
    .nav-link.active { background: var(--accent-glow); color: var(--accent); }
    .nav-link i { width: 16px; text-align: center; font-size: 0.8rem; }

    .sidebar-footer {
      padding: 0.75rem;
      border-top: 1px solid var(--border);
    }
    .logout-btn {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      width: 100%;
      padding: 0.55rem 0.75rem;
      border-radius: 8px;
      background: none;
      border: none;
      color: var(--danger);
      font-size: 0.85rem;
      font-weight: 500;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: background 0.15s;
      text-align: left;
    }
    .logout-btn:hover { background: rgba(248,81,73,0.1); }

    /* User card in sidebar */
    .sidebar-user {
      padding: 0.75rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }
    .user-avatar {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), #3fb950);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem;
      font-weight: 700;
      color: #0d1117;
      flex-shrink: 0;
    }
    .user-name  { font-size: 0.82rem; font-weight: 600; color: var(--text); }
    .user-role  { font-size: 0.7rem;  color: var(--muted); }

    /* ── TOPBAR ── */
    .topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: 56px;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 1.5rem;
      z-index: 50;
      gap: 1rem;
    }
    .topbar-title {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text);
      flex: 1;
    }
    .topbar-badge {
      font-size: 0.72rem;
      padding: 0.2rem 0.55rem;
      border-radius: 20px;
      font-weight: 600;
    }
    .badge-manager  { background: rgba(88,166,255,0.15);  color: var(--accent); }
    .badge-dev      { background: rgba(63,185,80,0.15);   color: var(--success); }
    .badge-bu       { background: rgba(210,153,34,0.15);  color: var(--warning); }

    /* ── MAIN CONTENT ── */
    .main-content {
      margin-left: var(--sidebar-w);
      margin-top: 56px;
      flex: 1;
      padding: 1.75rem;
      min-height: calc(100vh - 56px);
    }

    /* ── CARDS ── */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.25rem 1.5rem;
    }
    .card-title {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.07em;
      margin-bottom: 1rem;
    }

    /* ── TABLES ── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    thead th {
      padding: 0.6rem 0.9rem;
      text-align: left;
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--muted);
      border-bottom: 1px solid var(--border);
      white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid var(--border); transition: background 0.1s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    tbody td { padding: 0.7rem 0.9rem; color: var(--text); vertical-align: middle; }

    /* ── BADGES ── */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: 0.22rem 0.6rem;
      border-radius: 20px;
      font-size: 0.72rem;
      font-weight: 600;
      white-space: nowrap;
    }
    .badge-success  { background: rgba(63,185,80,0.15);  color: var(--success); }
    .badge-info     { background: rgba(56,139,253,0.15); color: var(--info); }
    .badge-primary  { background: rgba(88,166,255,0.15); color: var(--accent); }
    .badge-warning  { background: rgba(210,153,34,0.15); color: var(--warning); }
    .badge-danger   { background: rgba(248,81,73,0.15);  color: var(--danger); }

    /* ── BUTTONS ── */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.85rem;
      border-radius: 7px;
      font-size: 0.8rem;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      border: 1px solid transparent;
      text-decoration: none;
      transition: opacity 0.15s, box-shadow 0.15s;
    }
    .btn:hover { opacity: 0.82; }
    .btn-primary { background: var(--accent);   color: #0d1117; }
    .btn-info    { background: rgba(88,166,255,0.12); color: var(--accent);   border-color: rgba(88,166,255,0.3); }
    .btn-warning { background: rgba(210,153,34,0.12); color: var(--warning);  border-color: rgba(210,153,34,0.3); }
    .btn-danger  { background: rgba(248,81,73,0.12);  color: var(--danger);   border-color: rgba(248,81,73,0.3);  }
    .btn-success { background: rgba(63,185,80,0.12);  color: var(--success);  border-color: rgba(63,185,80,0.3);  }
    .btn-sm { padding: 0.28rem 0.65rem; font-size: 0.75rem; }
    .btn.disabled { opacity: 0.4; pointer-events: none; }

    /* ── FORMS ── */
    .form-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 0.35rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .form-control, .form-select {
      width: 100%;
      padding: 0.55rem 0.8rem;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 7px;
      color: var(--text);
      font-size: 0.875rem;
      font-family: 'Inter', sans-serif;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-glow);
    }
    .form-control.is-invalid { border-color: var(--danger); }
    .invalid-feedback { font-size: 0.78rem; color: var(--danger); margin-top: 0.25rem; display: block; }
    .mb-3 { margin-bottom: 1rem; }

    /* ── PAGE HEADER ── */
    .page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }
    .page-header h3 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
    }
    .page-header p {
      font-size: 0.82rem;
      color: var(--muted);
      margin-top: 0.15rem;
    }

    /* ── STAT CARDS ── */
    .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.1rem 1.25rem;
    }
    .stat-label { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.07em; color: var(--muted); }
    .stat-value { font-size: 1.75rem; font-weight: 700; margin: 0.3rem 0 0; color: var(--text); }
    .stat-icon  { font-size: 1rem; margin-bottom: 0.5rem; }

    /* ── FOOTER ── */
    footer { text-align: center; padding: 1rem; color: var(--muted); font-size: 0.75rem; border-top: 1px solid var(--border); margin-top: 2rem; }

    /* Logout form hidden */
    #logout-form { display: none; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-brand-icon"><i class="fa-solid fa-code-branch"></i></div>
      <div>
        <div class="sidebar-brand-text">{{ env('APP_NAME') }}</div>
        <div class="sidebar-brand-sub">IT Management</div>
      </div>
    </div>

    @auth
    <div class="sidebar-user">
      <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
      <div>
        <div class="user-name">{{ Auth::user()->name }}</div>
        <div class="user-role">
          @if(Auth::user()->usertype == 0) Manager
          @elseif(Auth::user()->usertype == 2) Developer
          @else Business Unit
          @endif
        </div>
      </div>
    </div>
    @endauth

    <nav class="sidebar-nav">
      <div class="sidebar-section">Main</div>
      @include('layouts.sidebar_bu')
    </nav>

    <div class="sidebar-footer">
      <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
      <button class="logout-btn" onclick="document.getElementById('logout-form').submit()">
        <i class="fa-solid fa-right-from-bracket"></i> Sign Out
      </button>
    </div>
  </aside>

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="topbar-title">@yield('topbar-title', 'Dashboard')</div>
    @auth
    <span class="topbar-badge
      @if(Auth::user()->usertype == 0) badge-manager
      @elseif(Auth::user()->usertype == 2) badge-dev
      @else badge-bu @endif">
      @if(Auth::user()->usertype == 0) Manager
      @elseif(Auth::user()->usertype == 2) Developer
      @else Business Unit
      @endif
    </span>
    @endauth
  </header>

  <!-- CONTENT -->
  <main class="main-content">
    @yield('content')
    <footer>{{ env('APP_NAME') }} &copy; {{ date('Y') }}</footer>
  </main>

</body>
</html>
