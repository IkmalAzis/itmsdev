<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.itms.dashboard') ? 'active' : '' }}"
       href="{{ route('app.itms.dashboard') }}">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Dashboard</span>
    </a>
</li>

@can('isManager')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.itms.project.*') ? 'active' : '' }}"
       href="{{ route('app.itms.project.index') }}">
        <i class="fa-solid fa-diagram-project"></i>
        <span>Project & System</span>
    </a>
</li>
@endcan

@can('isADev')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.itms.project.*') ? 'active' : '' }}"
       href="{{ route('app.itms.project.index') }}">
        <i class="fa-solid fa-list-check"></i>
        <span>My Progress</span>
    </a>
</li>
@endcan

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.itms.developer.*') ? 'active' : '' }}"
       href="{{ route('app.itms.developer.index') }}">
        <i class="fa-solid fa-users"></i>
        <span>Developers</span>
    </a>
</li>

@can('isManager')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app.itms.system.*') ? 'active' : '' }}"
       href="{{ route('app.itms.system.index') }}">
        <i class="fa-solid fa-server"></i>
        <span>Systems</span>
    </a>
</li>
@endcan
