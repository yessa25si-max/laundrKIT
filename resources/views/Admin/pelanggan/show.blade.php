@extends('admin.layouts.app')

@section('title', 'Detail Pelanggan')
@section('page_title', 'Detail Data Pelanggan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}" class="text-decoration-none">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail #{{ $pelanggan->pelanggan_id }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Detail Pelanggan: {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h3>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
        </a>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <div class="row g-4">
        <div class="col-md-6">
            <label class="text-muted small">Nama Lengkap</label>
            <h5 class="fw-bold text-dark">{{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h5>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Alamat Email</label>
            <h5 class="fw-semibold text-dark">{{ $pelanggan->email }}</h5>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Nomor Telepon / WhatsApp</label>
            <h5 class="fw-semibold text-dark">{{ $pelanggan->phone ?? '-' }}</h5>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Jenis Kelamin</label>
            <h5 class="fw-semibold text-dark">{{ $pelanggan->gender ?? '-' }}</h5>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Tanggal Lahir</label>
            <h5 class="fw-semibold text-dark">{{ $pelanggan->birthday ? \Carbon\Carbon::parse($pelanggan->birthday)->format('d F Y') : '-' }}</h5>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Tanggal Terdaftar</label>
            <h5 class="fw-semibold text-dark">{{ $pelanggan->created_at ? $pelanggan->created_at->format('d F Y H:i') : '-' }}</h5>
        </div>
    </div>
</div>
@endsection
