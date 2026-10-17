<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// Halaman Utama Publik / Landing Page
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman Admin Dashboard
Route::get('/admin-home', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin', [AdminController::class, 'index']);

// 3 Modul Master Data (Tanpa Relasi) dengan CRUD Lengkap
Route::resource('pelanggan', PelangganController::class);
Route::resource('layanan', LayananController::class);
Route::resource('barang', BarangController::class);
