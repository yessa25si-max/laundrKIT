@extends('admin.layouts.app')

@section('title', 'Detail Testimoni')
@section('page_title', 'Rincian Testimoni & Review Pelanggan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('testimoni.index') }}" class="text-decoration-none">Testimoni</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail #{{ $testimoni->testimoni_id }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Detail Ulasan Pelanggan</h3>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                <i class="fa-solid fa-bolt me-1"></i> Query Builder (DB::table)
            </span>
        </div>
        <p class="text-muted small mb-0">Informasi lengkap testimoni pelanggan, rating kepuasan, dan status publikasi.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('testimoni.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('testimoni.edit', $testimoni->testimoni_id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Ulasan
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Isi Ulasan -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle bg-warning-subtle text-warning fw-bold fs-4 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Rating Penilaian</div>
                        <div class="text-warning fs-5">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimoni->rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star text-muted opacity-50"></i>
                                @endif
                            @endfor
                            <span class="text-dark fw-bold ms-1">({{ $testimoni->rating }}.0 / 5.0)</span>
                        </div>
                    </div>
                </div>
                <div>
                    @if($testimoni->status_tampil == 'Tampilkan')
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                            <i class="fa-solid fa-globe me-1"></i> Publik (Tampil di Guest)
                        </span>
                    @else
                        <span class="badge bg-secondary-subtle text-secondary border px-3 py-2">
                            <i class="fa-solid fa-eye-slash me-1"></i> Disembunyikan
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-3 bg-light rounded-3 border mb-4">
                <div class="fw-semibold text-muted small mb-2"><i class="fa-solid fa-comment-dots text-primary me-1"></i> Isi Testimoni / Pengalaman:</div>
                <p class="fs-5 mb-0 text-dark fst-italic">
                    "{{ $testimoni->komentar }}"
                </p>
            </div>

            <table class="table table-borderless small mb-0">
                <tbody>
                    <tr>
                        <td class="text-muted" style="width: 180px;">Layanan Diulas:</td>
                        <td class="fw-bold">{{ $testimoni->nama_layanan }} ({{ $testimoni->kategori_layanan }})</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Transaksi:</td>
                        <td>
                            @if($testimoni->kode_transaksi)
                                <span class="badge bg-light text-dark border font-monospace">{{ $testimoni->kode_transaksi }}</span>
                            @else
                                <span class="text-muted">Tidak tertaut transaksi spesifik</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Ulasan:</td>
                        <td>{{ \Carbon\Carbon::parse($testimoni->tgl_ulasan)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Waktu Pencatatan:</td>
                        <td>{{ \Carbon\Carbon::parse($testimoni->created_at)->format('d/m/Y H:i') }} WIB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Kolom Kanan: Info Pelanggan Terkait -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 mb-4">
            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="fa-solid fa-user-check text-success me-2"></i> Pengulas
            </h5>
            <div class="text-center mb-3">
                <div class="avatar-circle mx-auto mb-2 bg-success-subtle text-success fw-bold fs-4 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px;">
                    {{ substr($testimoni->first_name, 0, 1) }}{{ substr($testimoni->last_name, 0, 1) }}
                </div>
                <h6 class="fw-bold mb-0">{{ $testimoni->first_name }} {{ $testimoni->last_name }}</h6>
                <span class="text-muted small">{{ $testimoni->pelanggan_email }}</span>
            </div>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item px-0 d-flex justify-content-between">
                    <span class="text-muted">No. Telepon:</span>
                    <span class="fw-semibold">{{ $testimoni->pelanggan_phone ?? '-' }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
