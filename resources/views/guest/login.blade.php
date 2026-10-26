@extends('guest.layouts.app')

@section('title', 'Login - Masuk ke LaundrKIT')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="auth-card">
                    <!-- Brand Icon Badge -->
                    <div class="auth-icon-badge">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">Masuk ke LaundrKIT</h3>
                        <p class="text-muted small">Silakan masukkan Username dan Password Anda untuk login</p>
                    </div>

                    <!-- Alert Notifikasi Login Error / Sukses -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3 d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2 fs-5 text-danger"></i>
                            <div><strong>Gagal!</strong> {{ session('error') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3 d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-circle-check me-2 fs-5 text-success"></i>
                            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Formulir Login (/auth) -->
                    <form action="{{ url('/auth') }}" method="POST">
                        @csrf

                        <!-- Inputan 1: Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="fa-solid fa-user me-1 text-danger"></i> Username
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text"
                                       name="username"
                                       id="username"
                                       class="form-control form-control-guest @error('username') is-invalid @enderror"
                                       placeholder="Masukkan Username atau Password sama"
                                       value="{{ old('username') }}"
                                       required
                                       autofocus>
                                @error('username')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Inputan 2: Password -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label mb-0">
                                    <i class="fa-solid fa-key me-1 text-danger"></i> Password
                                </label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control form-control-guest @error('password') is-invalid @enderror"
                                       placeholder="Masukkan Password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Info Petunjuk Soal 2 -->
                        <div class="p-2 mb-3 bg-light rounded text-muted small border">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i>
                            <strong>Petunjuk Login:</strong> Masukkan <em>Username</em> dan <em>Password</em> yang <strong>sama</strong> (contoh: <code>admin</code> & <code>admin</code>) untuk masuk ke Dashboard Admin.
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="#" class="small text-danger text-decoration-none">Lupa password?</a>
                        </div>

                        <!-- Tombol Submit Login -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn-brand-primary btn-lg">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk (Login)
                            </button>
                        </div>

                        <!-- Link ke Halaman Register -->
                        <div class="text-center pt-2">
                            <span class="text-muted small">Belum memiliki akun?</span>
                            <a href="{{ url('/register') }}" class="text-danger fw-bold small text-decoration-none ms-1">
                                Daftar di sini (/register)
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Link kembali ke Home -->
                <div class="text-center mt-3">
                    <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
