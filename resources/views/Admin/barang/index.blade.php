@extends('admin.layouts.app')

@section('title', 'Data Perlengkapan')
@section('page_title', 'Master Data Perlengkapan / Barang')

@section('content')
<!-- Header Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perlengkapan</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Data Perlengkapan & Stok Laundry</h3>
        <p class="text-muted small mb-0">Kelola persediaan bahan baku cuci, deterjen, pewangi, dan kemasan.</p>
    </div>
    <div>
        <a href="{{ route('barang.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-plus me-1"></i> Tambah Perlengkapan
        </a>
    </div>
</div>

<!-- Tabel Barang -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Kode</th>
                    <th>Nama Barang / Bahan</th>
                    <th>Kategori</th>
                    <th>Stok Tersedia</th>
                    <th>Harga Beli</th>
                    <th>Status Stok</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-dark-subtle text-dark border font-monospace">{{ $item->kode_barang }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $item->nama_barang }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border">{{ $item->kategori }}</span>
                        </td>
                        <td>
                            <span class="fw-bold text-dark">{{ $item->stok }}</span>
                            <span class="text-muted small">{{ $item->satuan }}</span>
                        </td>
                        <td>
                            <span class="text-muted small">Rp</span> {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($item->status == 'Tersedia')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <i class="fa-solid fa-circle-check me-1"></i> Tersedia
                                </span>
                            @elseif($item->status == 'Menipis')
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Menipis
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Habis
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('barang.edit', $item->barang_id) }}" class="btn btn-outline-primary" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('barang.destroy', $item->barang_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang {{ $item->nama_barang }}?');">
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
                            <div class="mb-2"><i class="fa-solid fa-boxes-stacked fs-1 text-secondary opacity-50"></i></div>
                            <p class="mb-1 fw-semibold">Belum ada data inventaris barang.</p>
                            <a href="{{ route('barang.create') }}" class="btn btn-sm btn-brand mt-2">Tambah Barang Baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
