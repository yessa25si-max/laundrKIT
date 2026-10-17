<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::latest('layanan_id')->get();

        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_layanan' => 'required|string|max:20|unique:layanan,kode_layanan',
            'nama_layanan' => 'required|string|max:100',
            'kategori' => 'required|in:Cuci Kiloan,Cuci Satuan,Dry Clean,Setrika Saja',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'durasi_jam' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:500',
        ], [
            'kode_layanan.required' => 'Kode layanan wajib diisi.',
            'kode_layanan.unique' => 'Kode layanan ini sudah dipakai, gunakan kode lain.',
            'nama_layanan.required' => 'Nama layanan cuci wajib diisi.',
            'kategori.required' => 'Pilih kategori layanan yang valid.',
            'harga.required' => 'Tarif/harga layanan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan hitung wajib diisi (misal: Kg, Pcs).',
            'durasi_jam.required' => 'Estimasi durasi pengerjaan wajib diisi.',
            'durasi_jam.integer' => 'Durasi pengerjaan harus berupa bilangan bulat.',
        ]);

        Layanan::create($validated);

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data Layanan Cuci baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'kode_layanan' => 'required|string|max:20|unique:layanan,kode_layanan,'.$layanan->layanan_id.',layanan_id',
            'nama_layanan' => 'required|string|max:100',
            'kategori' => 'required|in:Cuci Kiloan,Cuci Satuan,Dry Clean,Setrika Saja',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'durasi_jam' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:500',
        ], [
            'kode_layanan.required' => 'Kode layanan wajib diisi.',
            'kode_layanan.unique' => 'Kode layanan ini sudah dipakai oleh layanan lain.',
            'nama_layanan.required' => 'Nama layanan cuci wajib diisi.',
            'kategori.required' => 'Pilih kategori layanan yang valid.',
            'harga.required' => 'Tarif/harga layanan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan hitung wajib diisi.',
            'durasi_jam.required' => 'Estimasi durasi pengerjaan wajib diisi.',
            'durasi_jam.integer' => 'Durasi pengerjaan harus berupa bilangan bulat.',
        ]);

        $layanan->update($validated);

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data Layanan Cuci berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data Layanan Cuci berhasil dihapus!');
    }
}
