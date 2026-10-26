@extends('admin.layouts.app')

@section('title', 'Detail Pengguna: ' . $user->name)
@section('page_title', 'Detail Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="text-decoration-none">Data Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Detail Akun Pengguna</h3>
        <p class="text-muted small mb-0">Informasi lengkap akun pengguna yang terdaftar pada sistem.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-brand">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Pengguna
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-custom p-4 text-center">
            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center text-primary mx-auto mb-3 border shadow-sm" style="width: 88px; height: 88px; font-size: 2.5rem;">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
            <p class="text-muted mb-3">{{ $user->email }}</p>
            <div>
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                    <i class="fa-solid fa-circle-check me-1"></i> Akun Terverifikasi
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-custom p-4">
            <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">
                <i class="fa-solid fa-id-card text-primary me-2"></i>Informasi Detail Akun
            </h5>
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 200px;">ID Pengguna</td>
                            <td class="fw-bold text-dark">#{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Nama Lengkap</td>
                            <td class="fw-bold text-dark">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Alamat Email</td>
                            <td><a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Metode Enkripsi</td>
                            <td><span class="badge bg-light text-dark border">Bcrypt (Hash::make)</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Terdaftar Sejak</td>
                            <td class="text-dark">{{ $user->created_at ? $user->created_at->format('d M Y - H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Terakhir Diperbarui</td>
                            <td class="text-dark">{{ $user->updated_at ? $user->updated_at->format('d M Y - H:i:s') : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-trash me-1"></i> Hapus Akun Ini
                    </button>
                </form>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-brand">
                    <i class="fa-solid fa-pencil me-1"></i> Edit Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
