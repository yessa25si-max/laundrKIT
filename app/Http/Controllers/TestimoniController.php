<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller Testimoni: Menggunakan QUERY BUILDER (DB::table) murni.
 * Mendemonstrasikan SELECT, JOIN, INSERT, UPDATE, DELETE langsung melalui antarmuka Fluent Query Builder Laravel.
 */
class TestimoniController extends Controller
{
    /**
     * Tampilkan seluruh data testimoni / ulasan pelanggan.
     * Menggunakan Query Builder: DB::table, join, leftJoin, select, orderBy, get.
     */
    public function index(): View
    {
        $testimoni = DB::table('testimoni')
            ->join('pelanggan', 'testimoni.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->join('layanan', 'testimoni.layanan_id', '=', 'layanan.layanan_id')
            ->leftJoin('transaksi', 'testimoni.transaksi_id', '=', 'transaksi.transaksi_id')
            ->select(
                'testimoni.*',
                'pelanggan.first_name',
                'pelanggan.last_name',
                'pelanggan.email as pelanggan_email',
                'layanan.nama_layanan',
                'transaksi.kode_transaksi'
            )
            ->orderBy('testimoni.testimoni_id', 'desc')
            ->get();

        return view('admin.testimoni.index', compact('testimoni'));
    }

    /**
     * Tampilkan form pembuatan testimoni baru.
     * Menggunakan Query Builder untuk mengambil opsi data berelasi.
     */
    public function create(): View
    {
        $pelanggan = DB::table('pelanggan')
            ->select('pelanggan_id', 'first_name', 'last_name')
            ->orderBy('first_name')
            ->get();

        $layanan = DB::table('layanan')
            ->select('layanan_id', 'nama_layanan')
            ->orderBy('nama_layanan')
            ->get();

        $transaksi = DB::table('transaksi')
            ->select('transaksi_id', 'kode_transaksi')
            ->orderBy('transaksi_id', 'desc')
            ->get();

        return view('admin.testimoni.create', compact('pelanggan', 'layanan', 'transaksi'));
    }

    /**
     * Simpan testimoni baru ke database menggunakan Query Builder (DB::table->insert).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pelanggan,pelanggan_id'],
            'layanan_id' => ['required', 'exists:layanan,layanan_id'],
            'transaksi_id' => ['nullable', 'exists:transaksi,transaksi_id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['required', 'string', 'max:1000'],
            'status_tampil' => ['required', 'in:Tampilkan,Sembunyikan'],
            'tgl_ulasan' => ['required', 'date'],
        ], [
            'pelanggan_id.required' => 'Pilih pelanggan yang memberikan ulasan.',
            'layanan_id.required' => 'Pilih layanan yang diulas.',
            'rating.required' => 'Rating bintang (1-5) wajib dipilih.',
            'komentar.required' => 'Tuliskan isi ulasan / feedback pelanggan.',
            'status_tampil.required' => 'Tentukan status visibilitas testimoni.',
            'tgl_ulasan.required' => 'Tanggal ulasan wajib diisi.',
        ]);

        // Simpan menggunakan Query Builder DB::table('testimoni')->insert()
        DB::table('testimoni')->insert([
            'pelanggan_id' => $validated['pelanggan_id'],
            'layanan_id' => $validated['layanan_id'],
            'transaksi_id' => $validated['transaksi_id'] ?? null,
            'rating' => (int) $validated['rating'],
            'komentar' => $validated['komentar'],
            'status_tampil' => $validated['status_tampil'],
            'tgl_ulasan' => $validated['tgl_ulasan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('testimoni.index')
            ->with('success', 'Data Testimoni / Ulasan baru berhasil ditambahkan menggunakan Query Builder!');
    }

    /**
     * Tampilkan detail satu testimoni menggunakan Query Builder (DB::table->where->first).
     */
    public function show(string $id): View
    {
        $testimoni = DB::table('testimoni')
            ->join('pelanggan', 'testimoni.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->join('layanan', 'testimoni.layanan_id', '=', 'layanan.layanan_id')
            ->leftJoin('transaksi', 'testimoni.transaksi_id', '=', 'transaksi.transaksi_id')
            ->select(
                'testimoni.*',
                'pelanggan.first_name',
                'pelanggan.last_name',
                'pelanggan.email as pelanggan_email',
                'pelanggan.phone as pelanggan_phone',
                'layanan.nama_layanan',
                'layanan.kategori as kategori_layanan',
                'transaksi.kode_transaksi'
            )
            ->where('testimoni.testimoni_id', $id)
            ->first();

        if (! $testimoni) {
            abort(404, 'Data testimoni tidak ditemukan.');
        }

        return view('admin.testimoni.show', compact('testimoni'));
    }

    /**
     * Tampilkan form edit testimoni menggunakan Query Builder.
     */
    public function edit(string $id): View
    {
        $testimoni = DB::table('testimoni')->where('testimoni_id', $id)->first();

        if (! $testimoni) {
            abort(404, 'Data testimoni tidak ditemukan.');
        }

        $pelanggan = DB::table('pelanggan')
            ->select('pelanggan_id', 'first_name', 'last_name')
            ->orderBy('first_name')
            ->get();

        $layanan = DB::table('layanan')
            ->select('layanan_id', 'nama_layanan')
            ->orderBy('nama_layanan')
            ->get();

        $transaksi = DB::table('transaksi')
            ->select('transaksi_id', 'kode_transaksi')
            ->orderBy('transaksi_id', 'desc')
            ->get();

        return view('admin.testimoni.edit', compact('testimoni', 'pelanggan', 'layanan', 'transaksi'));
    }

    /**
     * Perbarui data testimoni menggunakan Query Builder (DB::table->where->update).
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pelanggan,pelanggan_id'],
            'layanan_id' => ['required', 'exists:layanan,layanan_id'],
            'transaksi_id' => ['nullable', 'exists:transaksi,transaksi_id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['required', 'string', 'max:1000'],
            'status_tampil' => ['required', 'in:Tampilkan,Sembunyikan'],
            'tgl_ulasan' => ['required', 'date'],
        ]);

        // Update menggunakan Query Builder
        DB::table('testimoni')
            ->where('testimoni_id', $id)
            ->update([
                'pelanggan_id' => $validated['pelanggan_id'],
                'layanan_id' => $validated['layanan_id'],
                'transaksi_id' => $validated['transaksi_id'] ?? null,
                'rating' => (int) $validated['rating'],
                'komentar' => $validated['komentar'],
                'status_tampil' => $validated['status_tampil'],
                'tgl_ulasan' => $validated['tgl_ulasan'],
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('testimoni.index')
            ->with('success', 'Data Testimoni berhasil diperbarui dengan Query Builder (DB::table)!');
    }

    /**
     * Hapus testimoni menggunakan Query Builder (DB::table->where->delete).
     */
    public function destroy(string $id): RedirectResponse
    {
        DB::table('testimoni')->where('testimoni_id', $id)->delete();

        return redirect()
            ->route('testimoni.index')
            ->with('success', 'Data Testimoni berhasil dihapus menggunakan Query Builder!');
    }
}
