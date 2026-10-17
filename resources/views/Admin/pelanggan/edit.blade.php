@extends('admin.layouts.app')

@section('title', 'Edit Pelanggan')
@section('page_title', 'Edit Data Pelanggan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}" class="text-decoration-none">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit #{{ $pelanggan->pelanggan_id }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Edit Data Pelanggan</h3>
        <p class="text-muted small mb-0">Perbarui data pelanggan {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}.</p>
    </div>
    <div>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('pelanggan.update', $pelanggan->pelanggan_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <!-- First Name -->
            <div class="col-md-6">
                <label for="first_name" class="form-label fw-semibold">Nama Depan (First Name) <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('first_name') is-invalid @enderror"
                       id="first_name"
                       name="first_name"
                       value="{{ old('first_name', $pelanggan->first_name) }}"
                       placeholder="Contoh: Budi">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="col-md-6">
                <label for="last_name" class="form-label fw-semibold">Nama Belakang (Last Name) <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('last_name') is-invalid @enderror"
                       id="last_name"
                       name="last_name"
                       value="{{ old('last_name', $pelanggan->last_name) }}"
                       placeholder="Contoh: Santoso">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       value="{{ old('email', $pelanggan->email) }}"
                       placeholder="budi@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label for="phone" class="form-label fw-semibold">Nomor WhatsApp / HP</label>
                <input type="text"
                       class="form-control @error('phone') is-invalid @enderror"
                       id="phone"
                       name="phone"
                       value="{{ old('phone', $pelanggan->phone) }}"
                       placeholder="081234567890">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gender -->
            <div class="col-md-6">
                <label for="gender" class="form-label fw-semibold">Jenis Kelamin</label>
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Male" {{ old('gender', $pelanggan->gender) == 'Male' ? 'selected' : '' }}>Laki-laki (Male)</option>
                    <option value="Female" {{ old('gender', $pelanggan->gender) == 'Female' ? 'selected' : '' }}>Perempuan (Female)</option>
                    <option value="Other" {{ old('gender', $pelanggan->gender) == 'Other' ? 'selected' : '' }}>Lainnya (Other)</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Birthday -->
            <div class="col-md-6">
                <label for="birthday" class="form-label fw-semibold">Tanggal Lahir</label>
                <input type="date"
                       class="form-control @error('birthday') is-invalid @enderror"
                       id="birthday"
                       name="birthday"
                       value="{{ old('birthday', $pelanggan->birthday) }}">
                @error('birthday')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="col-12 mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Perbarui Data
                </button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
