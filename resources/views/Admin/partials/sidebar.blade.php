<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand d-flex align-items-center justify-content-center py-2 px-3 rounded-3 bg-white mb-4 text-decoration-none shadow-sm">
        <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="laundryKIT" style="height: 36px; width: auto; object-fit: contain;">
    </a>

    <ul class="sidebar-nav">
        <li class="nav-category">Navigasi Utama</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->is('admin') || request()->is('admin-home') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-category">Manajemen Akun</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.*') || request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                <i class="fa-solid fa-user-shield"></i>
                <span>Data Pengguna (User)</span>
            </a>
        </li>

        <li class="nav-category">Master Data Laundry</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Data Pelanggan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">
                <i class="fa-solid fa-jug-detergent"></i>
                <span>Data Layanan Cuci</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Data Perlengkapan</span>
            </a>
        </li>

        <li class="nav-category">Website Publik</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Halaman Depan</span>
            </a>
        </li>
    </ul>

    <div class="pt-3 border-top border-secondary text-secondary small">
        <i class="fa-regular fa-circle-check text-success me-1"></i> Mode Admin Aktif
    </div>
</aside>
