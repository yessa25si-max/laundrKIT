<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT" style="height: 44px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.*') || request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('user.index') }}">Pengguna</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Layanan Cuci</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">Perlengkapan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.*') || request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-semibold text-muted d-none d-lg-inline"><i class="fa-solid fa-phone me-1 text-primary"></i> (08) 728 256 266</span>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary px-3">
                    <i class="fa-solid fa-gauge me-1"></i> Admin Panel
                </a>
            </div>
        </div>
    </div>
</nav>
