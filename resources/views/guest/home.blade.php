@extends('guest.layouts.app')

@section('title', 'Home - LaundrKIT Quality Laundry Service')

@section('content')
    <!-- Hero Section -->
    <section class="guest-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <span class="hero-badge">
                        <i class="fa-solid fa-sparkles"></i> Solusi Laundry Modern & Terpercaya
                    </span>
                    <h1 class="display-4 fw-bold text-dark mb-3">
                        Quality laundry service in your city
                    </h1>
                    <p class="lead text-muted mb-4">
                        We take care about cleanness of your cloth. Nikmati kemudahan layanan laundry cepat, higienis, dan wangi tahan lama dengan teknologi pencucian modern serta sistem pelacakan otomatis.
                    </p>
                    <div class="d-flex gap-3 flex-wrap align-items-center mb-4">
                        <a href="{{ url('/auth') }}" class="btn-brand-primary btn-lg">
                            <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang (/auth)
                        </a>
                        <a href="{{ url('/register') }}" class="btn-brand-outline btn-lg">
                            <i class="fa-solid fa-user-plus"></i> Daftar Akun (/register)
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark btn-lg px-4" style="border-radius: 10px;">
                            <i class="fa-solid fa-gauge me-1"></i> Panel Admin
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-4 text-muted small pt-2">
                        <div><i class="fa-solid fa-circle-check text-success me-1"></i> Gratis Jemput & Antar</div>
                        <div><i class="fa-solid fa-circle-check text-success me-1"></i> Detergen Ramah Serat</div>
                        <div><i class="fa-solid fa-circle-check text-success me-1"></i> Garansi Wangi 7 Hari</div>
                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="p-4 bg-white rounded-4 shadow-sm border border-light position-relative">
                        <div class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold mb-3">
                            <i class="fa-solid fa-fire me-1"></i> Layanan Terpopuler
                        </div>
                        <h4 class="fw-bold text-dark mb-3">Paket Cuci Express</h4>
                        <div class="display-5 fw-bold text-danger mb-2">Rp 12.000<span class="fs-6 text-muted fw-normal"> / kg</span></div>
                        <p class="text-muted small mb-4">Selesai dalam 3 jam, pakaian dicuci terpisah, disetrika uap, dan dipacking rapi higienis.</p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ url('/auth') }}" class="btn-brand-primary">
                                Pesan Layanan Ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold mb-2">Our Process</span>
                <h2 class="fw-bold text-dark">This is how we work</h2>
                <p class="text-muted">3 langkah mudah merawat pakaian Anda tanpa ribet</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card-process">
                        <div class="process-icon-circle">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">1. We collect your clothes</h5>
                        <p class="text-muted small mb-0">
                            Kurir kami akan menjemput pakaian kotor langsung di depan pintu rumah atau kosan Anda sesuai jadwal yang ditentukan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card-process">
                        <div class="process-icon-circle">
                            <i class="fa-solid fa-jug-detergent"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">2. Wash your clothes</h5>
                        <p class="text-muted small mb-0">
                            Pakaian dipilah, dicuci dengan mesin modern, air bersertifikat, detergen anti-kuman, dan disetrika uap berstandar tinggi.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card-process">
                        <div class="process-icon-circle">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">3. Get it delivered</h5>
                        <p class="text-muted small mb-0">
                            Pakaian bersih, wangi, dan terlipat rapi siap diantarkan kembali tepat waktu ke lokasi Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Kami Section -->
    <section class="py-5" style="background-color: #FFF8FB;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold mb-2">Pilihan Paket</span>
                <h2 class="fw-bold text-dark">Layanan Unggulan LaundrKIT</h2>
                <p class="text-muted">Pilihan paket cuci terlengkap yang disesuaikan dengan kebutuhan Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white">
                        <div class="text-danger fs-1 mb-3"><i class="fa-solid fa-shirt"></i></div>
                        <h5 class="fw-bold">Cuci Lipat Kiloan</h5>
                        <p class="text-muted small">Solusi hemat harian pakaian santai, celana, kaos, dan handuk.</p>
                        <div class="mt-auto pt-3 border-top fw-bold text-danger">Mulai Rp 6.000 / kg</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white">
                        <div class="text-danger fs-1 mb-3"><i class="fa-solid fa-temperature-arrow-up"></i></div>
                        <h5 class="fw-bold">Cuci + Setrika Uap</h5>
                        <p class="text-muted small">Cucian ekstra licin, wangi maksimal, dan siap langsung pakai kerja.</p>
                        <div class="mt-auto pt-3 border-top fw-bold text-danger">Mulai Rp 9.000 / kg</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white">
                        <div class="text-danger fs-1 mb-3"><i class="fa-solid fa-couch"></i></div>
                        <h5 class="fw-bold">Bed Cover & Selimut</h5>
                        <p class="text-muted small">Dicuci dengan tabung drum kapasitas besar agar debu tungau tuntas hilang.</p>
                        <div class="mt-auto pt-3 border-top fw-bold text-danger">Mulai Rp 25.000 / pcs</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white">
                        <div class="text-danger fs-1 mb-3"><i class="fa-solid fa-vest"></i></div>
                        <h5 class="fw-bold">Dry Cleaning Jas & Gaun</h5>
                        <p class="text-muted small">Perawatan spesial kain halus, batik sutra, jas formal, dan kebaya.</p>
                        <div class="mt-auto pt-3 border-top fw-bold text-danger">Mulai Rp 35.000 / pcs</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="p-5 rounded-4 text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #D95F91 0%, #B83267 100%);">
                <div class="position-relative" style="z-index: 2;">
                    <h2 class="fw-bold mb-3">Siap Mendapatkan Cucian Bersih & Harum?</h2>
                    <p class="lead mb-4 mx-auto" style="max-width: 650px;">
                        Daftar akun sekarang untuk memantau status cucian Anda atau login bila sudah memiliki akun.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ url('/register') }}" class="btn btn-light text-danger fw-bold btn-lg px-4" style="border-radius: 10px;">
                            <i class="fa-solid fa-user-plus me-1"></i> Daftar Akun (/register)
                        </a>
                        <a href="{{ url('/auth') }}" class="btn btn-outline-light fw-bold btn-lg px-4" style="border-radius: 10px;">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk Akun (/auth)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

