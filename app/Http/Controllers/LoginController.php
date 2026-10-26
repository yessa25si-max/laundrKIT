<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir Login.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check() || session()->has('logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('guest.login');
    }

    /**
     * Menangani form Login dengan logika sederhana:
     * - Jika username dan password sama, arahkan ke halaman Dashboard Admin.
     * - Jika salah (tidak sama), arahkan kembali ke halaman Login dengan Alert.
     */
    public function login(Request $request): RedirectResponse
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

        // Logika Sederhana: Jika username dan password sama
        if ($username === $password) {
            // Cek apakah akun terdaftar di database untuk integrasi Auth Laravel
            $user = User::where('name', $username)
                ->orWhere('email', $username)
                ->first();

            if ($user) {
                Auth::login($user);
            } else {
                // Simpan status login dan username ke session
                session([
                    'logged_in' => true,
                    'username' => $username,
                ]);
            }

            $request->session()->regenerate();

            // Arahkan ke halaman Dashboard Admin dengan pesan sukses
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

