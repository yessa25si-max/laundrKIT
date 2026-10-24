<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundryKIT - Quality Laundry Service</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background-color: #fce4ec;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #d81b60;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('layanan.index') }}">Layanan Cuci</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Perlengkapan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/admin-home') }}">Admin</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-semibold text-muted d-none d-lg-inline"><i class="fa-solid fa-phone me-1 text-primary"></i> (08) 728 256 266</span>
                    <a href="{{ url('/admin-home') }}" class="btn btn-primary px-3">
                        <i class="fa-solid fa-gauge me-1"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold mb-3">Sistem Informasi Laundry Modern</span>
                    <h1 class="display-4 fw-bold text-dark mb-3">Quality laundry service in your city</h1>
                    <p class="lead text-muted mb-4">We take care about cleanness of your cloth. Dilengkapi pengelolaan Master Data Pelanggan, Layanan Cuci, dan Perlengkapan.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-lg px-4 shadow-sm">
                            <i class="fa-solid fa-gauge me-1"></i> Buka Panel Admin
                        </a>
                        <a href="{{ route('layanan.index') }}" class="btn btn-outline-dark btn-lg px-4">
                            <i class="fa-solid fa-jug-detergent me-1"></i> Data Layanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process Section -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <p class="text-danger fw-bold text-uppercase mb-1">Our Process</p>
                <h2 class="fw-bold">This is how we work</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="p-4 border-0 card shadow-sm h-100">
                        <div class="mb-3">
                            <i class="fa-solid fa-basket-shopping feature-icon"></i>
                        </div>
                        <h5 class="fw-bold">We collect your clothes</h5>
                        <p class="text-muted">The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 text-center">
                    <div class="p-4 border-0 card shadow-sm h-100">
                        <div class="mb-3">
                            <i class="fa-solid fa-jug-detergent feature-icon"></i>
                        </div>
                        <h5 class="fw-bold">Wash your clothes</h5>
                        <p class="text-muted">The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 text-center">
                    <div class="p-4 border-0 card shadow-sm h-100">
                        <div class="mb-3">
                            <i class="fa-solid fa-truck-fast feature-icon"></i>
                        </div>
                        <h5 class="fw-bold">Get it delivered</h5>
                        <p class="text-muted">The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
