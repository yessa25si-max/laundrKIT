<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    /**
     * Tampilkan Halaman Utama Publik (Home / Landing Page).
     * Menerapkan pemanggilan data dengan ELOQUENT (Transaksi) dan QUERY BUILDER (Testimoni).
     */
    public function home(Request $request): View
    {
        // 1. Data Transaksi via ELOQUENT ORM (Relasi with 'pelanggan' dan 'layanan')
        $latestTransaksi = Transaksi::with(['pelanggan', 'layanan'])
            ->latest('transaksi_id')
            ->take(5)
            ->get();

        // Fitur Cek Status Cucian (Tracking) via Eloquent jika ada pencarian kode
        $searchResult = null;
        if ($request->filled('tracking_code')) {
            $code = trim($request->input('tracking_code'));
            $searchResult = Transaksi::with(['pelanggan', 'layanan'])
                ->where('kode_transaksi', $code)
                ->orWhereHas('pelanggan', function ($q) use ($code) {
                    $q->where('phone', $code);
                })
                ->first();
        }

        // 2. Data Testimoni via QUERY BUILDER (DB::table, JOIN pelanggan & layanan)
        $listTestimoni = DB::table('testimoni')
            ->join('pelanggan', 'testimoni.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->join('layanan', 'testimoni.layanan_id', '=', 'layanan.layanan_id')
            ->where('testimoni.status_tampil', 'Tampilkan')
            ->select(
                'testimoni.*',
                'pelanggan.first_name',
                'pelanggan.last_name',
                'layanan.nama_layanan'
            )
            ->orderBy('testimoni.rating', 'desc')
            ->orderBy('testimoni.created_at', 'desc')
            ->take(6)
            ->get();

        return view('guest.home', compact('latestTransaksi', 'searchResult', 'listTestimoni'));
    }

    /**
     * Tampilkan Halaman Login (/auth).
     */
    public function login(): View|RedirectResponse
    {
        if (Auth::check() || session()->has('logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('guest.login');
    }

    /**
     * Proses penanganan formulir Login (/auth) dengan logika sederhana:
     * - Jika username dan password sama, arahkan ke Dashboard Admin.
     * - Jika salah, arahkan kembali ke Login dengan Alert.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Kolom Username wajib diisi.',
            'password.required' => 'Kolom Password wajib diisi.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Logika sederhana: jika username dan password sama
        if ($username === $password) {
            $user = User::where('name', $username)
                ->orWhere('email', $username)
                ->first();

            if ($user) {
                Auth::login($user);
            } else {
                session([
                    'logged_in' => true,
                    'username' => $username,
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', "Login berhasil! Username dan password sama. Selamat datang, {$username}!");
        }

        // Jika salah / tidak sama, arahkan kembali ke halaman Login dengan Alert
        return redirect()->route('login')
            ->with('error', 'Login gagal! Username dan Password tidak sama.')
            ->withErrors([
                'username' => 'Username dan Password yang Anda masukkan tidak sama.',
            ])
            ->withInput($request->only('username'));
    }

    /**
     * Tampilkan Halaman Pendaftaran Akun (/register).
     */
    public function register(): View|RedirectResponse
    {
        if (Auth::check() || session()->has('logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('guest.register');
    }

    /**
     * Proses pendaftaran akun pengguna baru (/register).
     */
    public function storeRegister(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Kolom Name wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kolom Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi Confirm Password tidak cocok dengan Password.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pendaftaran akun berhasil! Selamat datang di LaundrKIT, '.$user->name.'.');
    }

    /**
     * Proses Keluar (Logout) pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->forget(['logged_in', 'username']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar (logout).');
    }
}
