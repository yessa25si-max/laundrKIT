<!-- Top Bar Informasi Publik -->
<div class="py-2 text-white small" style="background: linear-gradient(90deg, #D95F91 0%, #B83267 100%);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <span><i class="fa-solid fa-phone me-1"></i> (08) 728 256 266</span>
            <span class="d-none d-md-inline"><i class="fa-solid fa-envelope me-1"></i> info@laundrkit.id</span>
            <span class="d-none d-lg-inline"><i class="fa-solid fa-clock me-1"></i> Buka: 07.00 - 21.00 WIB</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="fw-semibold"><i class="fa-solid fa-sparkles me-1"></i> Layanan Laundry Modern & Higienis</span>
        </div>
    </div>
</div>

<!-- Guest Navigation Partial View -->
<nav class="navbar navbar-expand-lg guest-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT Logo" onerror="this.onerror=null; this.src='{{ asset('logo.png') }}';">
            <span>Laundr<strong style="color: #B83267;">KIT</strong></span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#guestNavbarNav" aria-controls="guestNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="guestNavbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fa-solid fa-house me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">
                        <i class="fa-solid fa-jug-detergent me-1"></i> Layanan Cuci
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
                        <i class="fa-solid fa-users me-1"></i> Pelanggan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                        <i class="fa-solid fa-boxes-stacked me-1"></i> Perlengkapan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.*') || request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-gauge me-1"></i> Admin Panel
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-brand-outline dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge me-2 text-primary"></i> Dashboard Admin</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ url('/auth') }}" class="btn btn-brand-outline btn-sm {{ request()->is('auth') || request()->is('login') ? 'active' : '' }}">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Login (/auth)
                    </a>
                    <a href="{{ url('/register') }}" class="btn btn-brand-primary btn-sm {{ request()->is('register') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus me-1"></i> Register (/register)
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

