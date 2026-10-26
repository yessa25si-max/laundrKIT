<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==========================================
// SOAL 1: TAMPILAN GUEST DENGAN PARTIAL VIEW
// ==========================================

// 1. Halaman Home ( / )
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/home', [GuestController::class, 'home']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================================
// SOAL 2: ROUTE & CONTROLLER FORM LOGIN
// ==========================================
// Menampilkan form login (GET)
Route::get('/auth', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);

// Menangani form login dengan logika sederhana (POST):
// - Jika username dan password sama -> Dashboard Admin
// - Jika salah -> Kembali ke Login dengan Alert
Route::post('/auth', [LoginController::class, 'login'])->name('login.process');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/authenticate', [LoginController::class, 'login'])->name('login.authenticate');

// ==========================================
// HALAMAN REGISTER & LOGOUT
// ==========================================

// Halaman Register ( /register )
Route::get('/register', [GuestController::class, 'register'])->name('register');
Route::post('/register', [GuestController::class, 'storeRegister'])->name('register.store');

// Logout Pengguna
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// TAMPILAN ADMIN & CRUD MASTER DATA
// ==========================================

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
