<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link {{ Request::is('karyawan*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Data Karyawan
            </a>
            {{-- {{ route('leaves.index') }} --}}
            <a class="nav-link {{ Request::is('cuti*') ? 'active' : '' }}" href="/cuti">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                Data Cuti
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{-- {{ Auth::user()->name ?? 'Guest' }} --}}
    </div>
</nav>
