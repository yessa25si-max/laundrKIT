<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Controller Transaksi: Menggunakan ELOQUENT ORM murni.
 * Mendemonstrasikan Model, Relasi BelongsTo/HasMany, Eager Loading (with), dan Operasi CRUD.
 */
class TransaksiController extends Controller
{
    /**
     * Tampilkan seluruh data transaksi laundry (Eloquent: with, latest, get).
     */
    public function index(): View
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan'])
            ->latest('transaksi_id')
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    /**
     * Tampilkan formulir untuk membuat transaksi baru (Eloquent: all/orderBy).
     */
    public function create(): View
    {
        $pelanggan = Pelanggan::orderBy('first_name')->get();
        $layanan = Layanan::orderBy('nama_layanan')->get();

        // Rekomendasi kode invoice otomatis
        $autoKode = 'TRX-'.date('Ymd').'-'.strtoupper(Str::random(4));

        return view('admin.transaksi.create', compact('pelanggan', 'layanan', 'autoKode'));
    }

    /**
     * Simpan transaksi baru ke database (Eloquent: create).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_transaksi' => ['nullable', 'string', 'max:30', 'unique:transaksi,kode_transaksi'],
            'pelanggan_id' => ['required', 'exists:pelanggan,pelanggan_id'],
            'layanan_id' => ['required', 'exists:layanan,layanan_id'],
            'berat_jumlah' => ['required', 'numeric', 'min:0.1'],
            'total_biaya' => ['nullable', 'numeric', 'min:0'],
            'tgl_masuk' => ['required', 'date'],
            'tgl_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:Baru,Diproses,Selesai,Diambil'],
            'status_pembayaran' => ['required', 'in:Belum Lunas,Lunas'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ], [
            'pelanggan_id.required' => 'Pilih data pelanggan yang bersangkutan.',
            'pelanggan_id.exists' => 'Data pelanggan tidak ditemukan.',
            'layanan_id.required' => 'Pilih jenis layanan cuci.',
            'layanan_id.exists' => 'Data layanan cuci tidak valid.',
            'berat_jumlah.required' => 'Jumlah berat (Kg) atau unit pakaian wajib diisi.',
            'berat_jumlah.numeric' => 'Jumlah berat/unit harus berupa angka.',
            'tgl_masuk.required' => 'Tanggal cucian masuk wajib diisi.',
            'status.required' => 'Pilih status pengerjaan cucian.',
            'status_pembayaran.required' => 'Pilih status pembayaran.',
        ]);

        if (empty($validated['kode_transaksi'])) {
            $validated['kode_transaksi'] = 'TRX-'.date('Ymd').'-'.strtoupper(Str::random(5));
        }

        // Hitung total biaya otomatis jika belum diinput
        if (empty($validated['total_biaya'])) {
            $selectedLayanan = Layanan::findOrFail($validated['layanan_id']);
            $validated['total_biaya'] = (int) round($selectedLayanan->harga * (float) $validated['berat_jumlah']);
        }

        Transaksi::create($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi Laundry baru berhasil dicatat menggunakan Eloquent ORM!');
    }

    /**
     * Tampilkan detail transaksi tertentu (Eloquent: with, findOrFail).
     */
    public function show(string $id): View
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan'])->findOrFail($id);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Tampilkan formulir edit transaksi (Eloquent: findOrFail).
     */
    public function edit(string $id): View
    {
        $transaksi = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::orderBy('first_name')->get();
        $layanan = Layanan::orderBy('nama_layanan')->get();

        return view('admin.transaksi.edit', compact('transaksi', 'pelanggan', 'layanan'));
    }

    /**
     * Perbarui data transaksi di database (Eloquent: update).
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'kode_transaksi' => ['required', 'string', 'max:30', 'unique:transaksi,kode_transaksi,'.$transaksi->transaksi_id.',transaksi_id'],
            'pelanggan_id' => ['required', 'exists:pelanggan,pelanggan_id'],
            'layanan_id' => ['required', 'exists:layanan,layanan_id'],
            'berat_jumlah' => ['required', 'numeric', 'min:0.1'],
            'total_biaya' => ['required', 'numeric', 'min:0'],
            'tgl_masuk' => ['required', 'date'],
            'tgl_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:Baru,Diproses,Selesai,Diambil'],
            'status_pembayaran' => ['required', 'in:Belum Lunas,Lunas'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        $transaksi->update($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', "Transaksi #{$transaksi->kode_transaksi} berhasil diperbarui dengan Eloquent ORM!");
    }

    /**
     * Hapus transaksi dari database (Eloquent: delete).
     */
    public function destroy(string $id): RedirectResponse
    {
        $transaksi = Transaksi::findOrFail($id);
        $kode = $transaksi->kode_transaksi;
        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', "Data Transaksi {$kode} berhasil dihapus menggunakan Eloquent ORM!");
    }
}
