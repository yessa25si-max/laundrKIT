@extends('admin.layouts.app')

@section('title', 'Edit Pengguna: ' . $user->name)
@section('page_title', 'Edit Pengguna: ' . $user->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="text-decoration-none">Data Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0 text-dark">Edit Data Pengguna</h3>
        <p class="text-muted small mb-0">Perbarui informasi kredensial akun pengguna: <strong>{{ $user->name }}</strong>.</p>
    </div>
    <div>
        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <div class="card-header bg-transparent border-0 px-0 pt-0 pb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-user-pen text-primary me-2"></i>Perbarui Kredensial Pengguna
        </h5>
    </div>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Menggunakan Partial View Form dengan repopulate data user --}}
        @include('admin.user._form', ['isEdit' => true, 'user' => $user])

        <hr class="my-4 text-muted">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('user.index') }}" class="btn btn-light px-4">Batal</a>
            <button type="submit" class="btn btn-brand px-4">
                <i class="fa-solid fa-rotate me-1"></i> Perbarui Data
            </button>
        </div>
    </form>
</div>
@endsection
