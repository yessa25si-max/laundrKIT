@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')
@section('page_title', 'Tambah Layanan Cuci Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none">Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Form Tambah Layanan Laundry</h3>
        <p class="text-muted small mb-0">Tambahkan tarif dan paket pencucian baru.</p>
    </div>
    <div>
        <a href="{{ route('layanan.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <!-- Kode Layanan -->
            <div class="col-md-4">
                <label for="kode_layanan" class="form-label fw-semibold">Kode Layanan <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('kode_layanan') is-invalid @enderror"
                       id="kode_layanan"
                       name="kode_layanan"
                       value="{{ old('kode_layanan') }}"
                       placeholder="Contoh: LYN-006">
                @error('kode_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Layanan -->
            <div class="col-md-8">
                <label for="nama_layanan" class="form-label fw-semibold">Nama Layanan Cuci <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('nama_layanan') is-invalid @enderror"
                       id="nama_layanan"
                       name="nama_layanan"
                       value="{{ old('nama_layanan') }}"
                       placeholder="Contoh: Cuci Karpet Tebal">
                @error('nama_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="col-md-4">
                <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Cuci Kiloan" {{ old('kategori') == 'Cuci Kiloan' ? 'selected' : '' }}>Cuci Kiloan</option>
                    <option value="Cuci Satuan" {{ old('kategori') == 'Cuci Satuan' ? 'selected' : '' }}>Cuci Satuan</option>
                    <option value="Dry Clean" {{ old('kategori') == 'Dry Clean' ? 'selected' : '' }}>Dry Clean</option>
                    <option value="Setrika Saja" {{ old('kategori') == 'Setrika Saja' ? 'selected' : '' }}>Setrika Saja</option>
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga -->
            <div class="col-md-4">
                <label for="harga" class="form-label fw-semibold">Tarif / Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('harga') is-invalid @enderror"
                       id="harga"
                       name="harga"
                       value="{{ old('harga') }}"
                       placeholder="10000"
                       min="0">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Satuan -->
            <div class="col-md-2">
                <label for="satuan" class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('satuan') is-invalid @enderror"
                       id="satuan"
                       name="satuan"
                       value="{{ old('satuan', 'Kg') }}"
                       placeholder="Kg / Pcs / Meter">
                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Durasi Jam -->
            <div class="col-md-2">
                <label for="durasi_jam" class="form-label fw-semibold">Durasi (Jam) <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('durasi_jam') is-invalid @enderror"
                       id="durasi_jam"
                       name="durasi_jam"
                       value="{{ old('durasi_jam', 24) }}"
                       placeholder="24"
                       min="1">
                @error('durasi_jam')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="col-12">
                <label for="deskripsi" class="form-label fw-semibold">Keterangan / Deskripsi Layanan</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          id="deskripsi"
                          name="deskripsi"
                          rows="3"
                          placeholder="Jelaskan detail fasilitas pengerjaan layanan ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="col-12 mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Layanan
                </button>
                <a href="{{ route('layanan.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
