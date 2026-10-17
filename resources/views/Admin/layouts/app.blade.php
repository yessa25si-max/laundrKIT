<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - LaundrKIT</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --brand-primary: #D95F91;
            --brand-primary-hover: #C24A7C;
            --brand-light: #FFF0F6;
            --brand-dark: #1F2937;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            color: #334155;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #1E293B 0%, #0F172A 100%);
            color: #E2E8F0;
            padding: 24px 16px;
            z-index: 1000;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 8px 12px 24px;
            font-size: 1.35rem;
            font-weight: 700;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 20px;
            text-decoration: none;
        }

        .sidebar-brand i {
            color: var(--brand-primary);
            font-size: 1.5rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-category {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748B;
            font-weight: 700;
            padding: 12px 14px 6px;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 4px;
        }

        .sidebar-nav .nav-link {
            color: #94A3B8;
            padding: 11px 14px;
            font-weight: 500;
            font-size: 0.92rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            color: #94A3B8;
            transition: color 0.2s ease;
        }

        .sidebar-nav .nav-link:hover {
            color: #FFFFFF;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .sidebar-nav .nav-link:hover i {
            color: var(--brand-primary);
        }

        .sidebar-nav .nav-link.active {
            color: #FFFFFF;
            background: linear-gradient(135deg, var(--brand-primary) 0%, #B83267 100%);
            box-shadow: 0 4px 12px rgba(217, 95, 145, 0.35);
        }

        .sidebar-nav .nav-link.active i {
            color: #FFFFFF;
        }

        /* Main Content Layout */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .page-body {
            padding: 32px;
            flex-grow: 1;
        }

        /* Card Custom */
        .card-custom {
            border: 1px solid #EDF2F7;
            border-radius: 14px;
            background-color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .btn-brand {
            background-color: var(--brand-primary);
            color: #FFFFFF;
            border: none;
            padding: 8px 18px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-brand:hover {
            background-color: var(--brand-primary-hover);
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(217, 95, 145, 0.3);
        }

        .badge-kategori {
            background-color: var(--brand-light);
            color: var(--brand-primary);
            font-weight: 600;
            border: 1px solid rgba(217, 95, 145, 0.2);
            padding: 5px 10px;
            border-radius: 6px;
        }

        .table > :not(caption) > * > * {
            padding: 14px 16px;
        }

        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand d-flex align-items-center justify-content-center py-2 px-3 rounded-3 bg-white mb-4 text-decoration-none shadow-sm">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="laundryKIT" style="height: 36px; width: auto; object-fit: contain;">
        </a>

        <ul class="sidebar-nav">
            <li class="nav-category">Navigasi Utama</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->is('admin-home') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-category">Master Data (3 Tabel)</li>
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

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Panel Pengelolaan:</span>
                <span class="fw-semibold text-dark">@yield('page_title', 'Admin Panel')</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold text-dark small">Administrator LaundrKIT</div>
                    <div class="text-muted" style="font-size: 0.75rem;">admin@laundrkit.local</div>
                </div>
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-secondary border" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
            </div>
        </header>

        <!-- Page Body Content -->
        <main class="page-body">

            {{-- Flash Message Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-check fs-5"></i>
                        <div>
                            <strong>Sukses!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Flash Message Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                        <div>
                            <strong>Peringatan!</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Global Validation Errors Alert --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fa-solid fa-circle-xmark fs-5 mt-1"></i>
                        <div>
                            <strong>Terjadi Kesalahan Validasi Input:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
