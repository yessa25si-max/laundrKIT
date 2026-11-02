@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni')
@section('page_title', 'Catat Testimoni Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('testimoni.index') }}" class="text-decoration-none">Testimoni</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Form Input Testimoni Pelanggan</h3>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                <i class="fa-solid fa-bolt me-1"></i> Query Builder (DB::table)
            </span>
        </div>
        <p class="text-muted small mb-0">Catat feedback atau review layanan dari pelanggan secara manual melalui antarmuka admin.</p>
    </div>
    <div>
        <a href="{{ route('testimoni.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('testimoni.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <!-- Pilih Pelanggan (Query Builder) -->
            <div class="col-md-4">
                <label for="pelanggan_id" class="form-label fw-semibold">Pelanggan <span class="text-danger">*</span></label>
                <select class="form-select @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->pelanggan_id }}" {{ old('pelanggan_id') == $p->pelanggan_id ? 'selected' : '' }}>
                            {{ $p->first_name }} {{ $p->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Layanan (Query Builder) -->
            <div class="col-md-4">
                <label for="layanan_id" class="form-label fw-semibold">Layanan Terkait <span class="text-danger">*</span></label>
                <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanan as $l)
                        <option value="{{ $l->layanan_id }}" {{ old('layanan_id') == $l->layanan_id ? 'selected' : '' }}>
                            {{ $l->nama_layanan }}
                        </option>
                    @endforeach
                </select>
                @error('layanan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Order / Transaksi Terkait (Opsional) -->
            <div class="col-md-4">
                <label for="transaksi_id" class="form-label fw-semibold">Transaksi / Nota (Opsional)</label>
                <select class="form-select @error('transaksi_id') is-invalid @enderror" id="transaksi_id" name="transaksi_id">
                    <option value="">-- Tidak Terhubung Transaksi Spesifik --</option>
                    @foreach($transaksi as $t)
                        <option value="{{ $t->transaksi_id }}" {{ old('transaksi_id') == $t->transaksi_id ? 'selected' : '' }}>
                            {{ $t->kode_transaksi }}
                        </option>
                    @endforeach
                </select>
                @error('transaksi_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rating Bintang -->
            <div class="col-md-4">
                <label for="rating" class="form-label fw-semibold">Rating Kepuasan <span class="text-danger">*</span></label>
                <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                    <option value="5" {{ old('rating', '5') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang - Sangat Puas)</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang - Puas)</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang - Cukup)</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2 Bintang - Kurang)</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐ (1 Bintang - Sangat Kurang)</option>
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Ulasan -->
            <div class="col-md-4">
                <label for="tgl_ulasan" class="form-label fw-semibold">Tanggal Ulasan <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tgl_ulasan') is-invalid @enderror"
                       id="tgl_ulasan"
                       name="tgl_ulasan"
                       value="{{ old('tgl_ulasan', date('Y-m-d')) }}"
                       required>
                @error('tgl_ulasan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Tampil -->
            <div class="col-md-4">
                <label for="status_tampil" class="form-label fw-semibold">Status Visibilitas Web <span class="text-danger">*</span></label>
                <select class="form-select @error('status_tampil') is-invalid @enderror" id="status_tampil" name="status_tampil" required>
                    <option value="Tampilkan" {{ old('status_tampil', 'Tampilkan') == 'Tampilkan' ? 'selected' : '' }}>Tampilkan di Halaman Guest</option>
                    <option value="Sembunyikan" {{ old('status_tampil') == 'Sembunyikan' ? 'selected' : '' }}>Sembunyikan Sementara</option>
                </select>
                @error('status_tampil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Isi Komentar -->
            <div class="col-12">
                <label for="komentar" class="form-label fw-semibold">Isi Testimoni / Komentar <span class="text-danger">*</span></label>
                <textarea class="form-control @error('komentar') is-invalid @enderror"
                          id="komentar"
                          name="komentar"
                          rows="4"
                          placeholder="Tuliskan pengalaman pelanggan terhadap kualitas cucian, keharuman, kerapian, atau kecepatan layanan..."
                          required>{{ old('komentar') }}</textarea>
                @error('komentar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="col-12 text-end pt-3 border-top">
                <a href="{{ route('testimoni.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan Testimoni (Query Builder)
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
