<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman Utama Publik / Landing Page
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman Admin Dashboard (Mendukung semua variasi URL agar tidak Not Found)
Route::get('/admin-home', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/home', [AdminController::class, 'index']);
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/adminhome', [AdminController::class, 'index']);

// Modul CRUD User (Pengguna) Lengkap
Route::resource('user', UserController::class);
Route::resource('users', UserController::class);

// 3 Modul Master Data (Tanpa Relasi) dengan CRUD Lengkap
Route::resource('pelanggan', PelangganController::class);
Route::resource('layanan', LayananController::class);
Route::resource('barang', BarangController::class);
