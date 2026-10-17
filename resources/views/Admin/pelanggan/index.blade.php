@extends('admin.layouts.app')

@section('title', 'Data Pelanggan')
@section('page_title', 'Master Data Pelanggan')

@section('content')
<!-- Header Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Data Pelanggan Laundry</h3>
        <p class="text-muted small mb-0">Kelola informasi data seluruh pelanggan setia LaundrKIT.</p>
    </div>
    <div>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-plus me-1"></i> Tambah Pelanggan
        </a>
    </div>
</div>

<!-- Tabel Pelanggan -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Gender</th>
                    <th>Tanggal Lahir</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $item->first_name }} {{ $item->last_name }}</div>
                            <span class="text-muted small">ID: #PLG-{{ str_pad($item->pelanggan_id, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <a href="mailto:{{ $item->email }}" class="text-decoration-none text-secondary">
                                <i class="fa-regular fa-envelope me-1"></i> {{ $item->email }}
                            </a>
                        </td>
                        <td>
                            @if($item->phone)
                                <span class="badge bg-light text-dark border">
                                    <i class="fa-solid fa-phone me-1 text-primary"></i> {{ $item->phone }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->gender == 'Male')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Laki-laki (Male)</span>
                            @elseif($item->gender == 'Female')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Perempuan (Female)</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ $item->gender ?? '-' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->birthday)
                                <span class="small"><i class="fa-regular fa-calendar me-1 text-muted"></i> {{ \Carbon\Carbon::parse($item->birthday)->format('d M Y') }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}" class="btn btn-outline-primary" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $item->first_name }} {{ $item->last_name }}?');">
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <div class="mb-2"><i class="fa-solid fa-user-slash fs-1 text-secondary opacity-50"></i></div>
                            <p class="mb-1 fw-semibold">Belum ada data pelanggan.</p>
                            <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-brand mt-2">Tambah Pelanggan Baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
