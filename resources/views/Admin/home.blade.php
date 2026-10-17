@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan Sistem')

@section('content')
<div class="row g-4 mb-4">
    <!-- Card Pelanggan -->
    <div class="col-md-4">
        <div class="card card-custom p-4 h-100 border-start border-4 border-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted text-uppercase small fw-bold">Total Pelanggan</span>
                    <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalPelanggan }}</h2>
                    <span class="text-muted small">Pelanggan terdaftar</span>
                </div>
                <div class="bg-primary-subtle text-primary p-3 rounded-circle fs-3">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="{{ route('pelanggan.index') }}" class="text-decoration-none small fw-semibold text-primary">
                    Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
    </div>

    <!-- Card Layanan -->
    <div class="col-md-4">
        <div class="card card-custom p-4 h-100 border-start border-4 border-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted text-uppercase small fw-bold">Paket Layanan</span>
                    <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalLayanan }}</h2>
                    <span class="text-muted small">Jenis layanan cuci</span>
                </div>
                <div class="bg-danger-subtle text-danger p-3 rounded-circle fs-3">
                    <i class="fa-solid fa-jug-detergent"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="{{ route('layanan.index') }}" class="text-decoration-none small fw-semibold text-danger">
                    Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('layanan.create') }}" class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
    </div>

    <!-- Card Perlengkapan -->
    <div class="col-md-4">
        <div class="card card-custom p-4 h-100 border-start border-4 border-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted text-uppercase small fw-bold">Perlengkapan / Stok</span>
                    <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalBarang }}</h2>
                    <span class="text-muted small">Item barang inventaris</span>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-circle fs-3">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="{{ route('barang.index') }}" class="text-decoration-none small fw-semibold text-success">
                    Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('barang.create') }}" class="btn btn-sm btn-outline-success">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Seksi Info Proyek Tugas -->
<div class="card card-custom p-4 mb-4 bg-white">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-clipboard-check text-primary me-2"></i>Status Tugas Master Data (3 Tabel)</h5>
            <p class="text-muted small mb-0">Semua 3 tabel master telah siap tanpa relasi beserta fungsi CRUD, Validasi, Flash Message & Repopulate Form.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-brand btn-sm">
                <i class="fa-solid fa-plus me-1"></i> Input Pelanggan
            </a>
            <a href="{{ route('layanan.create') }}" class="btn btn-outline-dark btn-sm">
                <i class="fa-solid fa-plus me-1"></i> Input Layanan
            </a>
            <a href="{{ route('barang.create') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-plus me-1"></i> Input Barang
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Preview Pelanggan Terakhir -->
    <div class="col-lg-6">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="fa-solid fa-users text-primary me-2"></i>Pelanggan Terbaru</h6>
                <a href="{{ route('pelanggan.index') }}" class="small text-decoration-none">Kelola &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestPelanggan as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->first_name }} {{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Preview Layanan Cuci Terakhir -->
    <div class="col-lg-6">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="fa-solid fa-jug-detergent text-danger me-2"></i>Daftar Paket Layanan</h6>
                <a href="{{ route('layanan.index') }}" class="small text-decoration-none">Kelola &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Layanan</th>
                            <th>Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestLayanan as $lay)
                            <tr>
                                <td><code>{{ $lay->kode_layanan }}</code></td>
                                <td class="fw-semibold">{{ $lay->nama_layanan }}</td>
                                <td>Rp {{ number_format($lay->harga, 0, ',', '.') }} / {{ $lay->satuan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada data layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
