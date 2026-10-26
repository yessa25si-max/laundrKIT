@extends('admin.layouts.app')

@section('title', 'Data Pengguna (User)')
@section('page_title', 'Manajemen Pengguna (User)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Data Pengguna (Users)</h3>
        <p class="text-muted small mb-0">Kelola kredensial akun pengguna sistem dengan enkripsi password Hash::make.</p>
    </div>
    <div>
        <a href="{{ route('user.create') }}" class="btn btn-brand">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Pengguna Baru
        </a>
    </div>
</div>

<div class="card card-custom p-0 overflow-hidden">
    <div class="p-3 bg-white border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                <i class="fa-solid fa-users me-1"></i> Total Pengguna: {{ $users->total() }}
            </span>
        </div>
        <div class="small text-muted">
            <i class="fa-solid fa-lock text-success me-1"></i> Password diamankan dengan Bcrypt (Hash::make)
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th scope="col" class="ps-4" style="width: 70px;">#</th>
                    <th scope="col">Nama Pengguna</th>
                    <th scope="col">Alamat Email</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col" class="text-end pe-4" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $item)
                    <tr>
                        <td class="ps-4 text-muted fw-bold">
                            {{ $users->firstItem() + $index }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 40px; height: 40px;">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <div>
                                    <span class="fw-semibold text-dark d-block">{{ $item->name }}</span>
                                    <small class="text-muted">ID: #{{ $item->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $item->email }}" class="text-decoration-none text-muted">
                                <i class="fa-regular fa-envelope me-1"></i>{{ $item->email }}
                            </a>
                        </td>
                        <td>
                            <span class="text-muted small">
                                <i class="fa-regular fa-clock me-1"></i>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('user.show', $item->id) }}" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-outline-warning" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $item->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus Data">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fa-solid fa-user-xmark fs-1 d-block mb-3 text-secondary"></i>
                                <h5 class="fw-semibold">Belum Ada Data Pengguna</h5>
                                <p class="small mb-3">Klik tombol di bawah untuk menambahkan pengguna pertama.</p>
                                <a href="{{ route('user.create') }}" class="btn btn-brand btn-sm">
                                    <i class="fa-solid fa-plus me-1"></i> Tambah Pengguna
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="p-3 bg-white border-top d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
