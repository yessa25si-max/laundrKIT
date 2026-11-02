@extends('admin.layouts.app')

@section('title', 'Data Testimoni')
@section('page_title', 'Master Data Testimoni & Review Pelanggan')

@section('content')
<!-- Header Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Testimoni</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Data Testimoni & Review</h3>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                <i class="fa-solid fa-bolt me-1"></i> Query Builder (DB::table)
            </span>
        </div>
        <p class="text-muted small mb-0">Kelola ulasan, penilaian bintang dari pelanggan, dan moderasi tampil pada halaman guest.</p>
    </div>
    <div>
        <a href="{{ route('testimoni.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-plus me-1"></i> Tambah Testimoni Baru
        </a>
    </div>
</div>

<!-- Card Ringkasan Singkat -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Total Testimoni</div>
                    <div class="fs-4 fw-bold text-dark">{{ $testimoni->count() }}</div>
                </div>
                <div class="bg-warning-subtle text-warning-emphasis p-3 rounded-circle">
                    <i class="fa-solid fa-comments fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Ditampilkan di Web</div>
                    <div class="fs-4 fw-bold text-dark">{{ $testimoni->where('status_tampil', 'Tampilkan')->count() }}</div>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-circle">
                    <i class="fa-solid fa-eye fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-info">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Rata-rata Rating</div>
                    <div class="fs-4 fw-bold text-dark">
                        {{ $testimoni->count() > 0 ? number_format($testimoni->avg('rating'), 1) : 0 }} / 5.0
                    </div>
                </div>
                <div class="bg-info-subtle text-info-emphasis p-3 rounded-circle">
                    <i class="fa-solid fa-star fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 border-start border-4 border-secondary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small">Ulasan Bintang 5</div>
                    <div class="fs-4 fw-bold text-dark">{{ $testimoni->where('rating', 5)->count() }}</div>
                </div>
                <div class="bg-secondary-subtle text-secondary p-3 rounded-circle">
                    <i class="fa-solid fa-award fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Testimoni (Query Builder) -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Pelanggan</th>
                    <th>Layanan & Order</th>
                    <th>Rating</th>
                    <th>Kutipan Ulasan</th>
                    <th>Status Tampil</th>
                    <th>Tanggal</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimoni as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $item->first_name }} {{ $item->last_name }}</div>
                            <span class="text-muted small">{{ $item->pelanggan_email }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold text-primary">{{ $item->nama_layanan }}</div>
                            @if($item->kode_transaksi)
                                <span class="badge bg-light text-muted border font-monospace">
                                    <i class="fa-solid fa-receipt me-1"></i>{{ $item->kode_transaksi }}
                                </span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $item->rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star text-muted opacity-50"></i>
                                    @endif
                                @endfor
                                <span class="fw-bold text-dark ms-1 small">({{ $item->rating }}.0)</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 text-dark small fst-italic" style="max-width: 280px;">
                                "{{ Str::limit($item->komentar, 65) }}"
                            </p>
                        </td>
                        <td>
                            @if($item->status_tampil == 'Tampilkan')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <i class="fa-solid fa-globe me-1"></i> Tampilkan
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border">
                                    <i class="fa-solid fa-eye-slash me-1"></i> Sembunyikan
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted small">
                                {{ \Carbon\Carbon::parse($item->tgl_ulasan)->format('d M Y') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('testimoni.show', $item->testimoni_id) }}" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('testimoni.edit', $item->testimoni_id) }}" class="btn btn-outline-primary" title="Edit Ulasan">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('testimoni.destroy', $item->testimoni_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan dari {{ $item->first_name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus Ulasan">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-comment-slash fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Belum ada testimoni pelanggan yang tercatat.</p>
                            <a href="{{ route('testimoni.create') }}" class="btn btn-brand btn-sm mt-3">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Testimoni Baru
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
