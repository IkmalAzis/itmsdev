<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.dashboard') ? 'active' : '' }}"
       href="{{ route('app.dashboard') }}">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.bu.*') ? 'active' : '' }}"
       href="{{ route('app.bu.index') }}">
        <i class="fa-solid fa-paper-plane"></i>
        <span>Application</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.profile.*') ? 'active' : '' }}"
       href="{{ route('app.profile.index') }}">
        <i class="fa-solid fa-user"></i>
        <span>Profile</span>
    </a>
</li>
