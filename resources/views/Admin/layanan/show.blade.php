@extends('admin.layouts.app')

@section('title', 'Detail Layanan')
@section('page_title', 'Detail Layanan Cuci')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none">Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $layanan->kode_layanan }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Detail Layanan: {{ $layanan->nama_layanan }}</h3>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('layanan.edit', $layanan->layanan_id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
        </a>
        <a href="{{ route('layanan.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <div class="row g-4">
        <div class="col-md-4">
            <label class="text-muted small">Kode Layanan</label>
            <h5 class="fw-bold text-dark">{{ $layanan->kode_layanan }}</h5>
        </div>
        <div class="col-md-8">
            <label class="text-muted small">Nama Layanan</label>
            <h5 class="fw-bold text-dark">{{ $layanan->nama_layanan }}</h5>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Kategori</label>
            <div><span class="badge bg-primary-subtle text-primary fs-6">{{ $layanan->kategori }}</span></div>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Tarif / Harga</label>
            <h5 class="fw-bold text-success">Rp {{ number_format($layanan->harga, 0, ',', '.') }} / {{ $layanan->satuan }}</h5>
        </div>
        <div class="col-md-4">
            <label class="text-muted small">Estimasi Durasi Pengerjaan</label>
            <h5 class="fw-semibold text-dark">{{ $layanan->durasi_jam }} Jam</h5>
        </div>
        <div class="col-12">
            <label class="text-muted small">Keterangan / Fasilitas</label>
            <p class="text-dark mb-0">{{ $layanan->deskripsi ?? 'Tidak ada keterangan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection
