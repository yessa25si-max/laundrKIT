@extends('admin.layouts.app')

@section('title', 'Detail Transaksi ' . $transaksi->kode_transaksi)
@section('page_title', 'Rincian Transaksi Laundry')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}" class="text-decoration-none">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $transaksi->kode_transaksi }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Invoice: {{ $transaksi->kode_transaksi }}</h3>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <i class="fa-solid fa-code me-1"></i> Eloquent ORM
            </span>
        </div>
        <p class="text-muted small mb-0">Rincian pesanan cuci, data pelanggan terhubung, dan riwayat status transaksi.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('transaksi.edit', $transaksi->transaksi_id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Transaksi
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Kartu Rincian Order -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3 flex-wrap gap-2">
                <div>
                    <span class="text-muted small">Nomor Resi / Transaksi</span>
                    <h4 class="fw-bold font-monospace text-brand mb-0">{{ $transaksi->kode_transaksi }}</h4>
                </div>
                <div>
                    @if($transaksi->status == 'Baru')
                        <span class="badge bg-secondary px-3 py-2 fs-6">Baru Masuk</span>
                    @elseif($transaksi->status == 'Diproses')
                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                            <i class="fa-solid fa-rotate fa-spin me-1"></i> Sedang Diproses
                        </span>
                    @elseif($transaksi->status == 'Selesai')
                        <span class="badge bg-info text-white px-3 py-2 fs-6">
                            <i class="fa-solid fa-circle-check me-1"></i> Selesai (Siap Diambil)
                        </span>
                    @elseif($transaksi->status == 'Diambil')
                        <span class="badge bg-success text-white px-3 py-2 fs-6">
                            <i class="fa-solid fa-bag-shopping me-1"></i> Sudah Diambil
                        </span>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted py-2" style="width: 200px;">Paket Layanan:</td>
                            <td class="fw-bold py-2">
                                {{ $transaksi->layanan->nama_layanan ?? '-' }}
                                <span class="badge bg-light text-muted border ms-2">{{ $transaksi->layanan->kategori ?? '-' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted py-2">Tarif Satuan:</td>
                            <td class="py-2">Rp {{ number_format($transaksi->layanan->harga ?? 0, 0, ',', '.') }} / {{ $transaksi->layanan->satuan ?? 'Kg' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-2">Berat / Kuantitas:</td>
                            <td class="fw-bold py-2">{{ $transaksi->berat_jumlah }} {{ $transaksi->layanan->satuan ?? 'Kg' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-2">Tanggal Masuk:</td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($transaksi->tgl_masuk)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-2">Estimasi / Selesai:</td>
                            <td class="py-2">
                                {{ $transaksi->tgl_selesai ? \Carbon\Carbon::parse($transaksi->tgl_selesai)->translatedFormat('l, d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted py-2">Status Pembayaran:</td>
                            <td class="py-2">
                                @if($transaksi->status_pembayaran == 'Lunas')
                                    <span class="badge bg-success text-white px-3 py-2"><i class="fa-solid fa-check me-1"></i> LUNAS</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2"><i class="fa-solid fa-clock me-1"></i> BELUM LUNAS</span>
                                @endif
                            </td>
                        </tr>
                        <tr class="border-top">
                            <td class="text-dark fw-bold fs-5 py-3">Total Tagihan:</td>
                            <td class="text-success fw-bold fs-4 py-3">
                                Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($transaksi->catatan)
                <div class="mt-4 p-3 bg-light rounded-3 border">
                    <div class="fw-semibold text-dark mb-1"><i class="fa-solid fa-note-sticky text-warning me-1"></i> Catatan Pelanggan:</div>
                    <div class="text-muted small">{{ $transaksi->catatan }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Kolom Kanan: Info Pelanggan Terelasi -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 mb-4">
            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="fa-solid fa-user text-primary me-2"></i> Data Pelanggan
            </h5>
            @if($transaksi->pelanggan)
                <div class="text-center mb-3">
                    <div class="avatar-circle mx-auto mb-2 bg-primary-subtle text-primary fw-bold fs-4 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px;">
                        {{ substr($transaksi->pelanggan->first_name, 0, 1) }}{{ substr($transaksi->pelanggan->last_name, 0, 1) }}
                    </div>
                    <h6 class="fw-bold mb-0">{{ $transaksi->pelanggan->first_name }} {{ $transaksi->pelanggan->last_name }}</h6>
                    <span class="text-muted small">{{ $transaksi->pelanggan->email }}</span>
                </div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">No. Telepon:</span>
                        <span class="fw-semibold">{{ $transaksi->pelanggan->phone ?? '-' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Gender:</span>
                        <span class="fw-semibold">{{ $transaksi->pelanggan->gender ?? '-' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Tgl Lahir:</span>
                        <span class="fw-semibold">{{ $transaksi->pelanggan->birthday ?? '-' }}</span>
                    </li>
                </ul>
                <div class="mt-3">
                    <a href="{{ route('pelanggan.show', $transaksi->pelanggan->pelanggan_id) }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fa-solid fa-address-card me-1"></i> Lihat Profil Pelanggan
                    </a>
                </div>
            @else
                <div class="text-muted">Data pelanggan tidak tersedia.</div>
            @endif
        </div>
    </div>
</div>
@endsection
