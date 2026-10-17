@extends('admin.layouts.app')

@section('title', 'Detail Perlengkapan')
@section('page_title', 'Detail Perlengkapan / Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}" class="text-decoration-none">Perlengkapan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $barang->kode_barang }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Detail Barang: {{ $barang->nama_barang }}</h3>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('barang.edit', $barang->barang_id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
        </a>
        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <div class="row g-4">
        <div class="col-md-4">
            <label class="text-muted small">Kode Barang</label>
            <h5 class="fw-bold text-dark">{{ $barang->kode_barang }}</h5>
        </div>
        <div class="col-md-8">
            <label class="text-muted small">Nama Barang</label>
            <h5 class="fw-bold text-dark">{{ $barang->nama_barang }}</h5>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Kategori</label>
            <div><span class="badge bg-secondary-subtle text-secondary fs-6">{{ $barang->kategori }}</span></div>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Stok Tersedia</label>
            <h5 class="fw-bold text-dark">{{ $barang->stok }} {{ $barang->satuan }}</h5>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Harga Beli Unit</label>
            <h5 class="fw-semibold text-dark">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</h5>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Status Ketersediaan</label>
            <div>
                @if($barang->status == 'Tersedia')
                    <span class="badge bg-success-subtle text-success fs-6"><i class="fa-solid fa-circle-check me-1"></i> Tersedia</span>
                @elseif($barang->status == 'Menipis')
                    <span class="badge bg-warning-subtle text-warning-emphasis fs-6"><i class="fa-solid fa-triangle-exclamation me-1"></i> Menipis</span>
                @else
                    <span class="badge bg-danger-subtle text-danger fs-6"><i class="fa-solid fa-circle-xmark me-1"></i> Habis</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
