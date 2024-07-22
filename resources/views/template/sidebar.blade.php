<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-ship"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIKIMON BC40</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @php
        $level = Auth::user()->user_level->id_user_level;
    @endphp
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if ($level == 13 || $level == 15 || $level == 17 || $level == 18)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('bc40-index') }}">
                <i class="fas fa-fw fa-file-import"></i>
                <span>Import File</span>
            </a>
        </li>
    @endif
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('bc40-browse') }}">
            <i class="fas fa-fw fa-globe"></i>
            <span>Browse</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
