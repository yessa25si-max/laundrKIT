@extends('admin.layouts.app')

@section('title', 'Data Transaksi')
@section('page_title', 'Master Data Transaksi Laundry')

@section('content')
<!-- Header Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Data Transaksi & Pesanan Laundry</h3>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <i class="fa-solid fa-database me-1"></i> Eloquent ORM
            </span>
        </div>
        <p class="text-muted small mb-0">Kelola order masuk, penimbangan cucian, status pengerjaan, dan pencatatan kasir.</p>
    </div>
    <div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-plus me-1"></i> Tambah Transaksi Baru
        </a>
    </div>
</div>

<!-- Card Ringkasan Singkat -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Total Order</div>
                    <div class="fs-4 fw-bold text-dark">{{ $transaksi->count() }}</div>
                </div>
                <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                    <i class="fa-solid fa-receipt fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Sedang Diproses</div>
                    <div class="fs-4 fw-bold text-dark">{{ $transaksi->where('status', 'Diproses')->count() }}</div>
                </div>
                <div class="bg-warning-subtle text-warning-emphasis p-3 rounded-circle">
                    <i class="fa-solid fa-spinner fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Selesai / Diambil</div>
                    <div class="fs-4 fw-bold text-dark">{{ $transaksi->whereIn('status', ['Selesai', 'Diambil'])->count() }}</div>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-circle">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-info">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Total Omset</div>
                    <div class="fs-5 fw-bold text-dark">Rp {{ number_format($transaksi->sum('total_biaya'), 0, ',', '.') }}</div>
                </div>
                <div class="bg-info-subtle text-info-emphasis p-3 rounded-circle">
                    <i class="fa-solid fa-money-bill-wave fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Transaksi -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Kode Order</th>
                    <th>Pelanggan</th>
                    <th>Layanan Dipilih</th>
                    <th>Bobot / Qty</th>
                    <th>Total Biaya</th>
                    <th>Status Cucian</th>
                    <th>Pembayaran</th>
                    <th>Tgl Masuk</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $item->transaksi_id) }}" class="fw-bold text-decoration-none text-brand font-monospace">
                                {{ $item->kode_transaksi }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">
                                {{ $item->pelanggan->first_name ?? '-' }} {{ $item->pelanggan->last_name ?? '' }}
                            </div>
                            <span class="text-muted small"><i class="fa-solid fa-phone me-1"></i>{{ $item->pelanggan->phone ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item->layanan->nama_layanan ?? '-' }}</div>
                            <span class="badge bg-light text-muted border">{{ $item->layanan->kategori ?? '-' }}</span>
                        </td>
                        <td>
                            <span class="fw-bold">{{ $item->berat_jumlah }}</span>
                            <span class="text-muted small">{{ $item->layanan->satuan ?? 'Kg' }}</span>
                        </td>
                        <td>
                            <span class="fw-bold text-success">Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($item->status == 'Baru')
                                <span class="badge bg-secondary-subtle text-secondary border">Baru Masuk</span>
                            @elseif($item->status == 'Diproses')
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                    <i class="fa-solid fa-rotate me-1 fa-spin"></i> Diproses
                                </span>
                            @elseif($item->status == 'Selesai')
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">
                                    <i class="fa-solid fa-circle-check me-1"></i> Selesai
                                </span>
                            @elseif($item->status == 'Diambil')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <i class="fa-solid fa-bag-shopping me-1"></i> Sudah Diambil
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($item->status_pembayaran == 'Lunas')
                                <span class="badge bg-success text-white">
                                    <i class="fa-solid fa-check me-1"></i> Lunas
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    <i class="fa-solid fa-clock me-1"></i> Belum Lunas
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted small">
                                <i class="fa-regular fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d M Y') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('transaksi.show', $item->transaksi_id) }}" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('transaksi.edit', $item->transaksi_id) }}" class="btn btn-outline-primary" title="Edit Transaksi">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $item->transaksi_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi {{ $item->kode_transaksi }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus Transaksi">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-receipt fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Belum ada transaksi laundry yang tercatat.</p>
                            <a href="{{ route('transaksi.create') }}" class="btn btn-brand btn-sm mt-3">
                                <i class="fa-solid fa-plus me-1"></i> Catat Transaksi Baru
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
