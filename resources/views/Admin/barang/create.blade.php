@extends('admin.layouts.app')

@section('title', 'Tambah Perlengkapan')
@section('page_title', 'Tambah Barang / Perlengkapan Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}" class="text-decoration-none">Perlengkapan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Form Tambah Perlengkapan Laundry</h3>
        <p class="text-muted small mb-0">Input data stok deterjen, pewangi, kemasan, atau peralatan operasional.</p>
    </div>
    <div>
        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <!-- Kode Barang -->
            <div class="col-md-4">
                <label for="kode_barang" class="form-label fw-semibold">Kode Barang <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('kode_barang') is-invalid @enderror"
                       id="kode_barang"
                       name="kode_barang"
                       value="{{ old('kode_barang') }}"
                       placeholder="Contoh: BRG-006">
                @error('kode_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Barang -->
            <div class="col-md-8">
                <label for="nama_barang" class="form-label fw-semibold">Nama Barang / Perlengkapan <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('nama_barang') is-invalid @enderror"
                       id="nama_barang"
                       name="nama_barang"
                       value="{{ old('nama_barang') }}"
                       placeholder="Contoh: Plastik Klip Laundry 30x40">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="col-md-6">
                <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Deterjen & Sabun" {{ old('kategori') == 'Deterjen & Sabun' ? 'selected' : '' }}>Deterjen & Sabun</option>
                    <option value="Pewangi & Softener" {{ old('kategori') == 'Pewangi & Softener' ? 'selected' : '' }}>Pewangi & Softener</option>
                    <option value="Plastik & Kemasan" {{ old('kategori') == 'Plastik & Kemasan' ? 'selected' : '' }}>Plastik & Kemasan</option>
                    <option value="Peralatan & Hanger" {{ old('kategori') == 'Peralatan & Hanger' ? 'selected' : '' }}>Peralatan & Hanger</option>
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stok -->
            <div class="col-md-3">
                <label for="stok" class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('stok') is-invalid @enderror"
                       id="stok"
                       name="stok"
                       value="{{ old('stok', 0) }}"
                       min="0">
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Satuan -->
            <div class="col-md-3">
                <label for="satuan" class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('satuan') is-invalid @enderror"
                       id="satuan"
                       name="satuan"
                       value="{{ old('satuan', 'Pcs') }}"
                       placeholder="Liter / Botol / Pack / Lusin">
                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga Beli -->
            <div class="col-md-6">
                <label for="harga_beli" class="form-label fw-semibold">Harga Beli per Unit (Rp) <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('harga_beli') is-invalid @enderror"
                       id="harga_beli"
                       name="harga_beli"
                       value="{{ old('harga_beli') }}"
                       placeholder="25000"
                       min="0">
                @error('harga_beli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold">Status Ketersediaan <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="Tersedia" {{ old('status', 'Tersedia') == 'Tersedia' ? 'selected' : '' }}>Tersedia (Aman)</option>
                    <option value="Menipis" {{ old('status') == 'Menipis' ? 'selected' : '' }}>Menipis (Perlu Restok)</option>
                    <option value="Habis" {{ old('status') == 'Habis' ? 'selected' : '' }}>Habis (Kosong)</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="col-12 mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perlengkapan
                </button>
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
