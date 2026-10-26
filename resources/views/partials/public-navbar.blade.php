<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT" style="height: 44px; width: auto;" onerror="this.onerror=null; this.src='{{ asset('logo.png') }}';">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('auth') || request()->is('login') ? 'active' : '' }}" href="{{ url('/auth') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ url('/register') }}">Register</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Layanan Cuci</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">Perlengkapan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.*') || request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('/auth') }}" class="btn btn-outline-danger btn-sm px-3">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-sm px-3">
                    <i class="fa-solid fa-gauge me-1"></i> Admin Panel
                </a>
            </div>
        </div>
    </div>
</nav>
