@extends('admin.layouts.app')

@section('title', 'Edit Transaksi')
@section('page_title', 'Perbarui Data Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}" class="text-decoration-none">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit #{{ $transaksi->kode_transaksi }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Edit Transaksi #{{ $transaksi->kode_transaksi }}</h3>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <i class="fa-solid fa-code me-1"></i> Eloquent ORM
            </span>
        </div>
        <p class="text-muted small mb-0">Ubah rincian pesanan, berat, status pengerjaan, atau status pembayaran.</p>
    </div>
    <div>
        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('transaksi.update', $transaksi->transaksi_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <!-- Kode Transaksi -->
            <div class="col-md-4">
                <label for="kode_transaksi" class="form-label fw-semibold">Kode Transaksi <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control font-monospace @error('kode_transaksi') is-invalid @enderror"
                       id="kode_transaksi"
                       name="kode_transaksi"
                       value="{{ old('kode_transaksi', $transaksi->kode_transaksi) }}"
                       required>
                @error('kode_transaksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Pelanggan (Relasi Eloquent) -->
            <div class="col-md-4">
                <label for="pelanggan_id" class="form-label fw-semibold">Pelanggan <span class="text-danger">*</span></label>
                <select class="form-select @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->pelanggan_id }}" {{ old('pelanggan_id', $transaksi->pelanggan_id) == $p->pelanggan_id ? 'selected' : '' }}>
                            {{ $p->first_name }} {{ $p->last_name }} ({{ $p->phone ?? $p->email }})
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Layanan (Relasi Eloquent) -->
            <div class="col-md-4">
                <label for="layanan_id" class="form-label fw-semibold">Paket Layanan <span class="text-danger">*</span></label>
                <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id" required>
                    <option value="" data-harga="0">-- Pilih Layanan --</option>
                    @foreach($layanan as $l)
                        <option value="{{ $l->layanan_id }}"
                                data-harga="{{ $l->harga }}"
                                data-satuan="{{ $l->satuan }}"
                                {{ old('layanan_id', $transaksi->layanan_id) == $l->layanan_id ? 'selected' : '' }}>
                            {{ $l->nama_layanan }} - Rp {{ number_format($l->harga, 0, ',', '.') }}/{{ $l->satuan }}
                        </option>
                    @endforeach
                </select>
                @error('layanan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Berat / Jumlah Unit -->
            <div class="col-md-3">
                <label for="berat_jumlah" class="form-label fw-semibold">Jumlah / Berat <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number"
                           step="0.1"
                           min="0.1"
                           class="form-control @error('berat_jumlah') is-invalid @enderror"
                           id="berat_jumlah"
                           name="berat_jumlah"
                           value="{{ old('berat_jumlah', $transaksi->berat_jumlah) }}"
                           required>
                    <span class="input-group-text bg-light text-muted" id="label-satuan">Kg / Pcs</span>
                </div>
                @error('berat_jumlah')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Biaya -->
            <div class="col-md-3">
                <label for="total_biaya" class="form-label fw-semibold">Total Biaya (Rp) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light fw-bold">Rp</span>
                    <input type="number"
                           min="0"
                           class="form-control @error('total_biaya') is-invalid @enderror"
                           id="total_biaya"
                           name="total_biaya"
                           value="{{ old('total_biaya', $transaksi->total_biaya) }}"
                           required>
                </div>
                @error('total_biaya')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Masuk -->
            <div class="col-md-3">
                <label for="tgl_masuk" class="form-label fw-semibold">Tanggal Masuk <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tgl_masuk') is-invalid @enderror"
                       id="tgl_masuk"
                       name="tgl_masuk"
                       value="{{ old('tgl_masuk', $transaksi->tgl_masuk) }}"
                       required>
                @error('tgl_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estimasi Tanggal Selesai -->
            <div class="col-md-3">
                <label for="tgl_selesai" class="form-label fw-semibold">Tanggal Selesai</label>
                <input type="date"
                       class="form-control @error('tgl_selesai') is-invalid @enderror"
                       id="tgl_selesai"
                       name="tgl_selesai"
                       value="{{ old('tgl_selesai', $transaksi->tgl_selesai) }}">
                @error('tgl_selesai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Cucian -->
            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold">Status Pengerjaan <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="Baru" {{ old('status', $transaksi->status) == 'Baru' ? 'selected' : '' }}>Baru Masuk</option>
                    <option value="Diproses" {{ old('status', $transaksi->status) == 'Diproses' ? 'selected' : '' }}>Diproses (Sedang Dicuci / Disetrika)</option>
                    <option value="Selesai" {{ old('status', $transaksi->status) == 'Selesai' ? 'selected' : '' }}>Selesai (Siap Diambil)</option>
                    <option value="Diambil" {{ old('status', $transaksi->status) == 'Diambil' ? 'selected' : '' }}>Diambil (Sudah Diterima)</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Pembayaran -->
            <div class="col-md-6">
                <label for="status_pembayaran" class="form-label fw-semibold">Status Pembayaran <span class="text-danger">*</span></label>
                <select class="form-select @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Belum Lunas" {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="Lunas" {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Catatan Khusus -->
            <div class="col-12">
                <label for="catatan" class="form-label fw-semibold">Catatan Khusus Cucian</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror"
                          id="catatan"
                          name="catatan"
                          rows="3">{{ old('catatan', $transaksi->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="col-12 text-end pt-3 border-top">
                <a href="{{ route('transaksi.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-save me-1"></i> Perbarui Transaksi (Eloquent)
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
