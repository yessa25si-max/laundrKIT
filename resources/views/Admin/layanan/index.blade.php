@extends('admin.layouts.app')

@section('title', 'Data Layanan')
@section('page_title', 'Master Data Layanan Cuci')

@section('content')
<!-- Header Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Layanan</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Data Paket & Layanan Laundry</h3>
        <p class="text-muted small mb-0">Kelola daftar harga dan jenis paket pencucian di LaundrKIT.</p>
    </div>
    <div>
        <a href="{{ route('layanan.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-plus me-1"></i> Tambah Layanan
        </a>
    </div>
</div>

<!-- Tabel Layanan -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Kode</th>
                    <th>Nama Layanan</th>
                    <th>Kategori</th>
                    <th>Tarif / Harga</th>
                    <th>Estimasi Waktu</th>
                    <th>Deskripsi Singkat</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanan as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-dark-subtle text-dark border font-monospace">{{ $item->kode_layanan }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $item->nama_layanan }}</div>
                        </td>
                        <td>
                            @if($item->kategori == 'Cuci Kiloan')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Cuci Kiloan</span>
                            @elseif($item->kategori == 'Cuci Satuan')
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">Cuci Satuan</span>
                            @elseif($item->kategori == 'Dry Clean')
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Dry Clean</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border">Setrika Saja</span>
                            @endif
                        </td>
                        <td>
                            <span class="fw-bold text-success">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <span class="text-muted small">/ {{ $item->satuan }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="fa-regular fa-clock me-1 text-primary"></i> {{ $item->durasi_jam }} Jam
                            </span>
                        </td>
                        <td>
                            <span class="text-muted small">{{ Str::limit($item->deskripsi ?? '-', 35) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('layanan.edit', $item->layanan_id) }}" class="btn btn-outline-primary" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('layanan.destroy', $item->layanan_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan {{ $item->nama_layanan }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="mb-2"><i class="fa-solid fa-jug-detergent fs-1 text-secondary opacity-50"></i></div>
                            <p class="mb-1 fw-semibold">Belum ada paket layanan.</p>
                            <a href="{{ route('layanan.create') }}" class="btn btn-sm btn-brand mt-2">Tambah Layanan Baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
