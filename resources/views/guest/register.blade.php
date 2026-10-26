@extends('guest.layouts.app')

@section('title', 'Register - Daftar Akun Baru LaundrKIT')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card">
                    <!-- Brand Icon Badge -->
                    <div class="auth-icon-badge">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">Daftar Akun Baru</h3>
                        <p class="text-muted small">Lengkapi data berikut untuk membuat akun di LaundrKIT</p>
                    </div>

                    <!-- Formulir Register (/register) -->
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <!-- Inputan 1: Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fa-solid fa-id-card me-1 text-danger"></i> Name
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control form-control-guest @error('name') is-invalid @enderror"
                                       placeholder="Masukkan Nama Lengkap Anda"
                                       value="{{ old('name') }}"
                                       required
                                       autofocus>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Inputan 2: Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fa-solid fa-envelope me-1 text-danger"></i> Email
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control form-control-guest @error('email') is-invalid @enderror"
                                       placeholder="contoh: nama@email.com"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Inputan 3: Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fa-solid fa-key me-1 text-danger"></i> Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control form-control-guest @error('password') is-invalid @enderror"
                                       placeholder="Minimal 6 karakter"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Inputan 4: Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="fa-solid fa-shield-halved me-1 text-danger"></i> Confirm Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
                                <input type="password"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       class="form-control form-control-guest @error('password_confirmation') is-invalid @enderror"
                                       placeholder="Ulangi konfirmasi password Anda"
                                       required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit Register -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn-brand-primary btn-lg">
                                <i class="fa-solid fa-user-plus me-1"></i> Daftar Akun (Register)
                            </button>
                        </div>

                        <!-- Link ke Halaman Login -->
                        <div class="text-center pt-2">
                            <span class="text-muted small">Sudah memiliki akun?</span>
                            <a href="{{ url('/auth') }}" class="text-danger fw-bold small text-decoration-none ms-1">
                                Masuk di sini (/auth)
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

